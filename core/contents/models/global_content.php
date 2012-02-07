<?php
	class GlobalContent extends ContentsAppModel{
		public $name = 'GlobalContent';

		public $useTable = 'global_contents';

		public $contentable = true;

		public $belongsTo = array(
			'GlobalLayout' => array(
				'className' => 'Contents.GlobalLayout',
				'foreignKey' => 'layout_id',
				'fields' => array(
					'GlobalLayout.id',
					'GlobalLayout.name',
					'GlobalLayout.model',
					'GlobalLayout.css',
					'GlobalLayout.html'
				)
			),
			'GlobalCategory' => array(
				'className' => 'Contents.GlobalCategory',
				'foreignKey' => 'global_category_id',
				'fields' => array(
					'GlobalCategory.id',
					'GlobalCategory.title',
				)
			),
			'Group' => array(
				'className' => 'Users.Group',
				'foreignKey' => 'group_id',
				'fields' => array(
					'Group.id',
					'Group.name'
				)
			),
			'ContentAuthor' => array(
				'className' => 'Users.User',
				'foreignKey' => 'author_id'
			),
			'ContentEditor' => array(
				'className' => 'Users.User',
				'foreignKey' => 'editor_id'
			)
		);

		public function __construct($id = false, $table = null, $ds = null) {
			parent::__construct($id, $table, $ds);

			$this->validate = array(
				'title' => array(
					'notEmpty' => array(
						'rule' => 'notEmpty',
						'message' => __('Please enter a name for this content item', true)
					)
				),
				'layout_id' => array(
					'notEmpty' => array(
						'rule' => 'notEmpty',
						'message' => __('Please select the layout for this content item', true)
					)
				),
				'body' => array(
					'notEmpty' => array(
						'rule' => 'notEmpty',
						'message' => __('Please enter the body of this content item', true)
					)
				)
			);
		}

		public function moveContent($model = null, $limit = 500){
			if(!$model){
				trigger_error(__('No model selected to move', true), E_USER_WARNING);
				return false;
			}

			if(!is_int($limit)){
				$limit = 500;
			}

			$return = array();
			$return['moved'] = 0;

			$Model = ClassRegistry::init($model);			
			$return['total'] = $Model->find(
				'count',
				array(					
					'conditions' => array(
						$Model->alias . '.' . $Model->displayField . ' IS NOT NULL'
					)
				)
			);

			if($Model->displayField == $Model->primaryKey){
				trigger_error(sprintf(__('Display field and primary key are the same for %s, cant move', true), $model), E_USER_WARNING);
				return false;
			}

			$rows = $Model->find(
				'all',
				array(
					'conditions' => array(
						$Model->alias . '.' . $Model->displayField . ' IS NOT NULL'
					),
					'contain' => false,
					'limit' => $limit
				)
			);
			
			foreach($rows as $row){
				$newContent = array();
				$newContent[$this->alias] = $row[$Model->alias];
				$newContent[$this->alias]['foreign_key'] = $row[$Model->alias][$Model->primaryKey];
				$newContent[$this->alias]['model'] = $Model->plugin . '.' . $Model->alias;

				if(!isset($newContent[$this->alias]['group_id'])) {
					$newContent[$this->alias]['group_id'] = 2;
				}
				
				unset($newContent[$this->alias][$Model->primaryKey]);
				$this->create();
				if($this->save($newContent)){
					$Model->id = $row[$Model->alias][$Model->primaryKey];
					$Model->saveField($Model->displayField, '', false);
					$return['moved']++;
				}
			}

			return $return;
		}

		public function getNewContentByMonth($months = 24) {
			$this->virtualFields['post_date'] = 'CONCAT_WS("/", YEAR(`' . $this->alias . '`.`created`), LPAD(MONTH(`' . $this->alias . '`.`created`), 2, 0))';
			$this->virtualFields['count_joins'] = 'COUNT(`' . $this->alias . '`.`id`)';

			$i = - $months;
			$dates = array();
			while($i <= 0) {
				$dates[date('Y/m', mktime(0, 0, 0, date('m') + $i, 1, date('Y')))] = null;
				$i++;
			}

			$new = $this->find(
				'list',
				array(
					'fields' => array(
						'post_date',
						'count_joins',
					),
					'conditions' => array(
						$this->alias . '.created >= ' => date('Y-m-d H:i:s', mktime(0, 0, 0, date('m') - $months, date('d'), date('Y')))
					),
					'group' => array(
						'post_date'
					)
				)
			);

			$updated = $this->find(
				'list',
				array(
					'fields' => array(
						'post_date',
						'count_joins',
					),
					'conditions' => array(
						$this->alias . '.created >= ' => date('Y-m-d H:i:s', mktime(0, 0, 0, date('m') - $months, date('d'), date('Y'))),
						$this->alias . '.created != ' . $this->alias . '.modified'
					),
					'group' => array(
						'post_date'
					)
				)
			);


			$Trash = ClassRegistry::init('Trash.Trash');
			$Trash->virtualFields['post_date'] = 'CONCAT_WS("/", YEAR(`' . $Trash->alias . '`.`deleted`), LPAD(MONTH(`' . $Trash->alias . '`.`deleted`), 2, 0))';
			$Trash->virtualFields['count_joins'] = 'COUNT(`' . $Trash->alias . '`.`id`)';

			$deleted = $Trash->find(
				'list',
				array(
					'fields' => array(
						'post_date',
						'count_joins',
					),
					'conditions' => array(
						$Trash->alias . '.model LIKE ' => 'Contents%',
						$Trash->alias . '.deleted >= ' => date('Y-m-d H:i:s', mktime(0, 0, 0, date('m') - $months, date('d'), date('Y')))
					),
					'group' => array(
						'post_date'
					)
				)
			);

			$labels = array();
			foreach(array_keys($dates) as $k => $v) {
				if($k % 2 == 0) {
					$labels[] = $v;
				}
				else {
					$labels[] = '';
				}
			}
			$dates = array_fill_keys(array_keys($dates), 0);
			
			return array(
				'labels' => $labels,
				'new' => array_merge($dates, $new),
				'updated' => array_merge($dates, $updated),
				'deleted' => array_merge($dates, $deleted)
			);
		}
	}