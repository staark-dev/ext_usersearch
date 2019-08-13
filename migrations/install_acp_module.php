<?php
/**
 *
 * Search user by email. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2019, Costin Ionut, https://github.com/SSYTOfficial
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace ssyt\usersearch\migrations;

class install_acp_module extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['ssyt_usersearch_enable']);
	}

	public static function depends_on()
	{
		return array('\phpbb\db\migration\data\v320\v320');
	}

	public function update_data()
	{
		return array(
			array('config.add', array('ssyt_usersearch_enable', 0)),

			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_USERSEARCH_TITLE'
			)),

			array('module.add', array(
				'acp',
				'ACP_USERSEARCH_TITLE',
				array(
					'module_basename'	=> '\ssyt\usersearch\acp\usersearch_module',
					'modes'				=> array('settings'),
				),
			)),
		);
	}
}
