<?php
	class ModuleFixture extends CakeTestFixture {
			public $table = 'core_modules';

			public $fields = 	array(
				'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
				'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
				'content' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
				'module' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
				'config' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
				'theme_id' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
				'position_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
				'group_id' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
				'ordering' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
				'admin' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'key' => 'index'),
				'active' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
				'show_heading' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
				'core' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
				'author' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
				'licence' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 75, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
				'url' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
				'update_url' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
				'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
				'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
				'plugin' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
				'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'name' => array('column' => 'name', 'unique' => 1), 'active' => array('column' => array('admin', 'active'), 'unique' => 0), 'ordering' => array('column' => 'ordering', 'unique' => 0), 'module_loader_by_position' => array('column' => array('position_id', 'admin', 'active', 'ordering'), 'unique' => 0)),
				'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
			);

			public $records = 	array(
				array(
					'id' => 'module-login',
					'name' => 'login',
					'content' => '',
					'module' => 'login',
					'config' => '',
					'theme_id' => 0,
					'position_id' => 'module-position-custom1',
					'group_id' => 2,
					'ordering' => 1,
					'admin' => 0,
					'active' => 1,
					'show_heading' => 0,
					'core' => 0,
					'author' => 'Infinitas',
					'licence' => 'MIT',
					'url' => 'http://www.infinitas-cms.org',
					'update_url' => '',
					'created' => '2010-01-19 00:30:53',
					'modified' => '2010-06-02 14:53:06',
					'plugin' => 'Management'
				),
				array(
					'id' => 'module-popular-posts',
					'name' => 'Popular Posts',
					'content' => '',
					'module' => '',
					'config' => '',
					'theme_id' => 0,
					'position_id' => 'module-position-right',
					'group_id' => 1,
					'ordering' => 1,
					'admin' => 0,
					'active' => 1,
					'show_heading' => 1,
					'core' => 0,
					'author' => 'Infinitas',
					'licence' => 'MIT',
					'url' => 'http://www.infinitas-cms.org',
					'update_url' => '',
					'created' => '2010-01-19 00:58:20',
					'modified' => '2010-05-12 03:40:56',
					'plugin' => 'Blog'
				),
				array(
					'id' => 'module-search',
					'name' => 'search',
					'content' => '',
					'module' => 'search',
					'config' => '',
					'theme_id' => 0,
					'position_id' => 'module-position-custom1',
					'group_id' => 2,
					'ordering' => 2,
					'admin' => 0,
					'active' => 1,
					'show_heading' => 0,
					'core' => 1,
					'author' => 'Infinitas',
					'licence' => 'MIT',
					'url' => 'http://www.infinitas-cms.org',
					'update_url' => '',
					'created' => '2010-01-19 11:22:09',
					'modified' => '2010-08-05 00:22:18',
					'plugin' => 'News'
				),
				array(
					'id' => 'module-some-news',
					'name' => 'News module',
					'content' => '',
					'module' => 'news',
					'config' => '',
					'theme_id' => 0,
					'position_id' => 'module-position-custom3',
					'group_id' => 2,
					'ordering' => 4,
					'admin' => 0,
					'active' => 1,
					'show_heading' => 1,
					'core' => 0,
					'author' => 'Infinitas',
					'licence' => 'MIT',
					'url' => 'http://www.infinitas-cms.org',
					'update_url' => '',
					'created' => '2010-01-19 11:40:45',
					'modified' => '2010-08-16 16:49:06',
					'plugin' => 'News'
				),
				array(
					'id' => 'module-admin-menu',
					'name' => 'Admin Menu',
					'content' => '',
					'module' => 'menu',
					'config' => '{\"menu\":\"core_admin\"}',
					'theme_id' => 0,
					'position_id' => 'module-position-top',
					'group_id' => 1,
					'ordering' => 1,
					'admin' => 1,
					'active' => 1,
					'show_heading' => 0,
					'core' => 1,
					'author' => 'Infinitas',
					'licence' => 'MIT',
					'url' => 'http://www.infinitas-cms.org',
					'update_url' => '',
					'created' => '2010-01-27 18:14:16',
					'modified' => '2010-05-07 19:05:29',
					'plugin' => 'Management'
				),
				array(
					'id' => 'module-frontend-menu',
					'name' => 'Frontend Menu',
					'content' => '',
					'module' => 'main_menu',
					'config' => '{\"public\":\"main_menu\",\"registered\":\"registered_users\"}',
					'theme_id' => 0,
					'position_id' => 'module-position-top',
					'group_id' => 2,
					'ordering' => 2,
					'admin' => 0,
					'active' => 1,
					'show_heading' => 0,
					'core' => 1,
					'author' => 'Infinitas',
					'licence' => 'MIT',
					'url' => 'http://www.infinitas-cms.org',
					'update_url' => '',
					'created' => '2010-02-01 00:57:01',
					'modified' => '2010-05-13 20:29:15',
					'plugin' => 'Management'
				),
				array(
					'id' => 'module-tags',
					'name' => 'Tag Cloud',
					'content' => '',
					'module' => 'post_tag_cloud',
					'config' => '',
					'theme_id' => 0,
					'position_id' => 'module-position-right',
					'group_id' => 2,
					'ordering' => 4,
					'admin' => 0,
					'active' => 1,
					'show_heading' => 1,
					'core' => 1,
					'author' => 'Infinitas',
					'licence' => 'MIT',
					'url' => 'http://www.infinitas-cms.org',
					'update_url' => '',
					'created' => '2010-02-01 16:01:01',
					'modified' => '2010-05-07 19:06:29',
					'plugin' => 'Blog'
				),
				array(
					'id' => 'module-post-dates',
					'name' => 'Post Dates',
					'content' => '',
					'module' => 'post_dates',
					'config' => '',
					'theme_id' => 0,
					'position_id' => 'module-position-right',
					'group_id' => 2,
					'ordering' => 5,
					'admin' => 0,
					'active' => 1,
					'show_heading' => 1,
					'core' => 1,
					'author' => 'Infinitas',
					'licence' => 'MIT',
					'url' => 'http://www.infinitas-cms.org',
					'update_url' => '',
					'created' => '2010-02-01 16:34:00',
					'modified' => '2010-05-07 19:06:56',
					'plugin' => 'Blog'
				),
				array(
					'id' => 'module-google-analytics',
					'name' => 'Google analytics',
					'content' => '',
					'module' => 'google_analytics',
					'config' => '{\"code\":\"UA-xxxxxxxx-x\"}',
					'theme_id' => 0,
					'position_id' => 'module-position-hidden',
					'group_id' => 2,
					'ordering' => 1,
					'admin' => 0,
					'active' => 0,
					'show_heading' => 0,
					'core' => 1,
					'author' => 'Infinitas',
					'licence' => 'MIT',
					'url' => 'http://www.infinitas-cms.org',
					'update_url' => '',
					'created' => '2010-02-01 20:45:05',
					'modified' => '2010-08-05 01:47:17',
					'plugin' => 'Google'
				),
				array(
					'id' => 'module-ratings',
					'name' => 'Rate This',
					'content' => '',
					'module' => 'rate',
					'config' => '',
					'theme_id' => 0,
					'position_id' => 'module-position-right',
					'group_id' => 2,
					'ordering' => 1,
					'admin' => 0,
					'active' => 1,
					'show_heading' => 1,
					'core' => 0,
					'author' => 'Infinitas',
					'licence' => 'MIT',
					'url' => 'http://www.infinitas-cms.org',
					'update_url' => '',
					'created' => '2010-05-10 20:06:53',
					'modified' => '2010-05-11 12:40:08',
					'plugin' => 'Management'
				),
			);
		}