<?php
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
define('DB_NAME', 'cybersis03');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'cybersis03');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '8f70cfd');

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
define('AUTH_KEY', 			'a7f57023a55ae502661c7e2d3f76cc5851a2f34cb6b84e74591306a9cd90f81a');
define('SECURE_AUTH_KEY', 	'5d748fbdcdc38a40c33bbb4687a2c0ad9f8bdf70135a6c4ed1ee278bf531997b');
define('LOGGED_IN_KEY', 	'e020acb341c3b5f72719322b605e2f2c4f58799e43c7d1447908bbc6cc7a5892');
define('NONCE_KEY', 		'07428083b4e77eb9e1e9dd87a38f62482b2a1e736cc04df197d3cdc49c576a75');
define('AUTH_SALT',			'47e14fbf8a9cd7d766231e138b0c120580c910ed93189d045475ddcca2a1adc3');
define('SECURE_AUTH_SALT',	'2ec4be37ace78f70764af5d1cee3c01c4d7f44864b396784dd4605e1ced9db37');
define('LOGGED_IN_SALT',	'6a13095ea2b8e752b40fa1a62b165de7dbdd29240802441146416124b34adc3b');
define('NONCE_SALT',		'd36b3df43b8c8fb3a79b6ba27559d68409b36df0391538c8e5a4a2a6e1daa483');
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
