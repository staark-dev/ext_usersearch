<?php
/**
 *
 * Search user by email. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2019, Costin Ionut, https://github.com/SSYTOfficial
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace ssyt\usersearch\acp;

/**
 * Search user by email ACP module info.
 */
class usersearch_info
{
	public function module()
	{
		return array(
			'filename'	=> '\ssyt\usersearch\acp\usersearch_module',
			'title'		=> 'ACP_USERSEARCH_TITLE',
			'modes'		=> array(
				'settings'	=> array(
					'title'	=> 'ACP_USERSEARCH',
					'auth'	=> 'ext_ssyt/usersearch && acl_a_board',
					'cat'	=> array('ACP_USERSEARCH_TITLE')
				),
			),
		);
	}
}
