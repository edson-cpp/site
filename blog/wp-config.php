<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

/** 
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configuraçções de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
 //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/cybersis/www/blog/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'cybersis01');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'cybersis01');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', 'd3e134f');

/** nome do host do MySQL */
define('DB_HOST', 'mysql.cybersis.com.br');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando {@link http://api.wordpress.org/secret-key/1.1/ WordPress.org secret-key service}
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 			'40df878cfd85da4dbdb4a245753d06ac0f673e72e0d9ac6087d499149abed7fb');
define('SECURE_AUTH_KEY', 	'2195d6c5a15cf08be53226857906158d333986b44af67f269c18d194f52ad4cc');
define('LOGGED_IN_KEY', 	'0181bfb7b458096428586fe8572d19287a003a55eaa9e3e36af4aaf1a449aab0');
define('NONCE_KEY', 		'5ef309b573b6c5e10e59589951f52654c07c91ffad79187a9e7189ba3463928f');
define('AUTH_SALT',			'3e156a5a7064eebad666705cf462a8180ca55e7d40170facf081237ea6cc4926');
define('SECURE_AUTH_SALT',	'50d3235de9dd0d59df4245299368c43060ee791bdbaf28564d1877f648a548a9');
define('LOGGED_IN_SALT',	'28b924ad91c9c0a13056eedd245ff511e329188d3e92b0111638fe7700a9f6a7');
define('NONCE_SALT',		'd9699b8b53a04720c8eeaca1a95487315c32519c4c3a63b4c0b6a423eab7d530');
/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';

/**
 * O idioma localizado do WordPress é o inglês por padrão.
 *
 * Altere esta definição para localizar o WordPress. Um arquivo MO correspondente a
 * língua escolhida deve ser instalado em wp-content/languages. Por exemplo, instale
 * pt_BR.mo em wp-content/languages e altere WPLANG para 'pt_BR' para habilitar o suporte
 * ao português do Brasil.
 */
define ('WPLANG', 'pt_BR');

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto do WordPress para o diretório Wordpress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
?>
