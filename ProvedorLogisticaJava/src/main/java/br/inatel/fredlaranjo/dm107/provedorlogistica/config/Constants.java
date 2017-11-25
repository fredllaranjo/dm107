package br.inatel.fredlaranjo.dm107.provedorlogistica.config;

/**
 * Hold system constants and configuration values.
 * @author fredlaranjo
 *
 */
public final class Constants {
	private Constants() {}//prevent instantiation
	public static final String DB_URL = "jdbc:mysql://localhost/provlog";
	public static final String DB_USER = "root";
	public static final String DB_PASS = "root";
	public static final String AUTHORIZATION_HEADER = "Authorization";
}
