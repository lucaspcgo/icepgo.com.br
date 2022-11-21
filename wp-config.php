<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'belfiu90_wp737' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'belfiu90_wp737' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', '7pS6f44Y.)' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'fuQ*lG} Fp-uN#1WVi*@ek3aUGLA7reKT|O6AvY+}pBg`:![npTQ|r8.H MVEF7>' );
define( 'SECURE_AUTH_KEY',  'DUa8>fT%+6*.lI5+93Y9|P4r5z|Wj#=9mX~,NmD^9zn2l,OMFyZG:(-Up:R;E/%Y' );
define( 'LOGGED_IN_KEY',    't22]&/0`,}s`@b)?Z<a14|l#i<#x%PKnlGR7(c=/z>%MkSQ<Fh*u6;}S+i|w}vRz' );
define( 'NONCE_KEY',        'FqZ!JQNKGj=02Yo8pxqN-qSviYGhTChDeJhWb-x;X{KAKBn=C*=(0prucQ12-_Zc' );
define( 'AUTH_SALT',        'L,ho7@SzH,PXE.j{3?VWcT,S5V_s5]:!*/+#m80IjR*HNHQJ}%>?=,PHi>;6Eang' );
define( 'SECURE_AUTH_SALT', '];_*t)GzFl8r308#m~)gtN)Up_B|<?nZl!WV}w/f9kF@=lB3_Aj ]T6KiK IBJsX' );
define( 'LOGGED_IN_SALT',   '*/Pu%@l4,)zj%{[5:qw56t=k9| QN [+fgd9r[F5PG@Av.6p$0}b4QwKgXeer|Gn' );
define( 'NONCE_SALT',       '?DKG=2wyZiGRi5]~fXX5t|[e9l@WH;-T2.w(u&!SgdDIY5k_3@F?5w;h|8`D06(s' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wp2q_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Configura as variáveis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';
