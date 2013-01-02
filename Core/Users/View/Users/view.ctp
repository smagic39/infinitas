<?php
/**
 * User profile page
 *
 * @copyright Copyright (c) 2010 Carl Sutton ( dogmatic69 )
 * @link http://www.infinitas-cms.org
 * @package Infinitas.Users.View
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @since 0.8a
 *
 * @author Carl Sutton <dogmatic69@gmail.com>
 */

$profileParts = $this->Event->trigger('userProfile', $user);
foreach ($profileParts['userProfile'] as $plugin => &$profile) {
	$id = 'accordion' . String::uuid();
	$profile['title'] = $this->Html->link($profile['title'], $this->here . '#' . $id, array(
		'class' => 'accordion-toggle',
		'data-toggle' => 'collapse',
		'data-parent' => 'accordion-plugin'
	));
	$profile['content'] = $this->Html->tag('div', $profile['content'], array(
		'class' => 'accordion-inner'
	));
	$profile = $this->Html->tag('div', implode('', array(
		$this->Html->tag('div', $profile['title'], array(
			'class' => 'accordion-heading'
		)),
		$this->Html->tag('div', $profile['content'], array(
			'class' => 'accordion-body collapse',
			'id' => $id
		))
	)), array('class' => 'accordion-group'));
}
$profileParts = $this->Html->tag('div', implode('', $profileParts['userProfile']), array(
	'class' => 'accordion'
));

$left = $this->Html->tag('div', implode('', array(
	$this->Html->tag('h4', $user['User']['username']),
	$this->Html->tag('dl', implode('', array(
		$this->Html->tag('dt', __d('user', 'Full Name')),
		$this->Html->tag('dd', $user['User']['full_name'] . '&nbsp;'),
		$this->Html->tag('dt', __d('user', 'Prefered name')),
		$this->Html->tag('dd', $user['User']['prefered_name'] . '&nbsp;'),
		$this->Html->tag('dt', __d('user', 'Email')),
		$this->Html->tag('dd', $user['User']['email']),
	)), array('class' => 'dl-horizontal')),
	$this->Html->tag('h4', __d('users', 'Activity')),
	$this->Html->tag('dl', implode('', array(
		$this->Html->tag('dt', __d('buckabe', 'Logged in')),
		$this->Html->tag('dd', CakeTime::timeAgoInWords($user['User']['last_login'])),
		$this->Html->tag('dt', __d('buckabe', 'IP Address')),
		$this->Html->tag('dd', $user['User']['ip_address']),
	)), array('class' => 'dl-horizontal'))
)), array('class' => 'span8'));

echo $this->Html->tag('div', $left . $this->Html->tag('div', $profileParts, array('class' => 'span4')), array(
	'class' => 'row'
));
echo $this->Html->tag('div', __d('users',
	'For help or support please %s',
	$this->Html->link(__d('contacts', 'contact us'), array(
		'plugin' => 'newsletter',
		'controller' => 'newsletters',
		'action' => 'contact'
	))
), array('class' => 'alert'));
