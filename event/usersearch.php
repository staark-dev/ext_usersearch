<?php
/**
 *
 * Search user by email. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2019, Costin Ionut, https://github.com/SSYTOfficial
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace ssyt\usersearch\event;

/**
 * @ignore
 */
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Search user by email Event listener.
 */
class usersearch implements EventSubscriberInterface
{
	public static function getSubscribedEvents()
	{
		return array(
			'core.user_setup'							=> 'load_language_on_setup',
			'core.adm_page_header'						=> 'main'
		);
	}

	var $u_action;
	var $p_master;

	/* @var \phpbb\language\language */
	protected $language;

	/* @var \phpbb\controller\helper */
	protected $helper;

	/* @var \phpbb\template\template */
	protected $template;

	/** @var string phpEx */
	protected $php_ext;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/**
	 * Constructor
	 *
	 * @param \phpbb\language\language	$language	Language object
	 * @param \phpbb\controller\helper	$helper		Controller helper object
	 * @param \phpbb\template\template	$template	Template object
	 * @param string                    $php_ext    phpEx
	 */
	public function __construct(\phpbb\config\config $config, \phpbb\request\request $request, \phpbb\language\language $language, \phpbb\controller\helper $helper, \phpbb\template\template $template, $php_ext, \phpbb\db\driver\driver_interface $db)
	{
		$this->config	= $config;
		$this->request	= $request;
		$this->language = $language;
		$this->helper   = $helper;
		$this->template = $template;
		$this->php_ext  = $php_ext;
		$this->db		= $db;
	}

	/**
	 * Load common language files during user setup
	 *
	 * @param \phpbb\event\data	$event	Event object
	 */
	public function load_language_on_setup($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'ssyt/usersearch',
			'lang_set' => 'common',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}

	public function main($id, $mode)
	{
		global $phpbb_root_path, $phpbb_admin_path;
		//include($phpbb_root_path . 'includes/functions' . $this->php_ext);

		$email 		= $this->request->variable('userMail', '', false);
		$method 	= $this->u_action;
		$action		= $this->request->variable('action', '', false);
		$dataUsers  = array();

		if (!empty($email)) {
			$sql = 'SELECT user_id, username
				FROM ' . USERS_TABLE . '
			WHERE user_email = "' . $this->db->sql_escape($email) . '"';

			$result = $this->db->sql_query($sql);
			$dataUsers = $this->db->sql_fetchrow($result);
			$this->db->sql_freeresult($result);
		}

		// Action search
		if ($this->request->is_set_post('submituser_search'))
		{
			if (!empty($dataUsers))
			{
				$tmp = '<form id="acp_board" method="post"><fieldset>'.
					'<legend>Informatii utilizator</legend>'.
					'<dl>'.
						'<label for="user">Nume Utilizator:</label>'.
						'<dd><strong>'. $dataUsers['username'] .'</strong></dd>'.
					'</dl>'.

					'<dl>'.
						'<label for="user">ID Utilizator:</label>'.
						'<dd><strong>'. $dataUsers['user_id'] .'</strong></dd>'.
					'</dl>'.
				'</fieldset></form>';

				$this->template->assign_vars(array(
					'USER_SEARCH_TMP'	=> $tmp,
				));
			}
		}

		$this->template->assign_vars(array(
			'SSYT_USERSEARCH_ENABLE'	=> (bool) $this->config['ssyt_usersearch_enable'],
			'USER_SEARCH'				=> 'ANNONYMOUS',
		));
	}
}

//
//L_ENTER_USER
//