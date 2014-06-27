<?php
/**
 * WordPress基础配置文件。
 *
 * 本文件包含以下配置选项：MySQL设置、数据库表名前缀、密钥、
 * WordPress语言设定以及ABSPATH。如需更多信息，请访问
 * {@link http://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 * 编辑wp-config.php}Codex页面。MySQL设置具体信息请咨询您的空间提供商。
 *
 * 这个文件被安装程序用于自动生成wp-config.php配置文件，
 * 您可以手动复制这个文件，并重命名为“wp-config.php”，然后填入相关信息。
 *
 * @package WordPress
 */

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** WordPress数据库的名称 */
define('DB_NAME', 'baoxiaoy_dev');

/** MySQL数据库用户名 */
define('DB_USER', 'baoxiaoy_mysql');

/** MySQL数据库密码 */
define('DB_PASSWORD', 'yuan008598');

/** MySQL主机 */
define('DB_HOST', '192.185.24.212');

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8');

/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', '');

/**#@+
 * 身份认证密钥与盐。
 *
 * 修改为任意独一无二的字串！
 * 或者直接访问{@link https://api.wordpress.org/secret-key/1.1/salt/
 * WordPress.org密钥生成服务}
 * 任何修改都会导致所有cookies失效，所有用户将必须重新登录。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ':Gw[Hdz#y5.-,{(Dd7wp[n_#e]CTZ`d#Tj|?5xra -,H>>$sQE+C3z}d`-uLz?%)');
define('SECURE_AUTH_KEY',  '{?!Au c }Dge1U^P{HG-B/H;{aHs_VAi+(X4}c(a^O2_POt{a+]Fo%/#qqM(GLwb');
define('LOGGED_IN_KEY',    '%KQdfuD;I[ N~#|:mPF(>-T4-!n1AYGzUktPMd?j1b %mpf(~BBT-EjFyk&s$#6C');
define('NONCE_KEY',        'U=YtgK`Q:rS8!YP~ -b7=nP(iS+Js.LOroJ%p}eI&KK#?H64dFkw|vv6Xr`,YY#|');
define('AUTH_SALT',        'ir@t)+IYrp|@i|O.:3>|6),wfR:LX->idJdzD+ 6iMFNXo7~3Peu#~uPCCSsx%2I');
define('SECURE_AUTH_SALT', '%|+VXTY45}vv[$Z,1:4IcVc~Df`2 xU.NOd5s?^}ozJ!X-gf7f-@?AC+E+-}-f16');
define('LOGGED_IN_SALT',   'L|F3Y[j})Wc6R9V5 OA*-]UgH<]X[Hw{/r}e:xl79r>%*-x6:&G:!K::zr?MyTr-');
define('NONCE_SALT',       'T|).h:!pqIHBL9=gQu`GLl%qOF]oBo?dcQy?;8lm{_#EWN&4-RnbqxZs$WR:F,`O');

/**#@-*/

/**
 * WordPress数据表前缀。
 *
 * 如果您有在同一数据库内安装多个WordPress的需求，请为每个WordPress设置
 * 不同的数据表前缀。前缀名只能为数字、字母加下划线。
 */
$table_prefix  = 'lvyuan_';

/**
 * WordPress语言设置，中文版本默认为中文。
 *
 * 本项设定能够让WordPress显示您需要的语言。
 * wp-content/languages内应放置同名的.mo语言文件。
 * 例如，要使用WordPress简体中文界面，请在wp-content/languages
 * 放入zh_CN.mo，并将WPLANG设为'zh_CN'。
 */
define('WPLANG', 'zh_CN');

/**
 * 开发者专用：WordPress调试模式。
 *
 * 将这个值改为true，WordPress将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用WP_DEBUG。
 */
define('WP_DEBUG', false);

/**
 * zh_CN本地化设置：启用ICP备案号显示
 *
 * 可在设置→常规中修改。
 * 如需禁用，请移除或注释掉本行。
 */
define('WP_ZH_CN_ICP_NUM', true);

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress目录的绝对路径。 */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** 设置WordPress变量和包含文件。 */
require_once(ABSPATH . 'wp-settings.php');
