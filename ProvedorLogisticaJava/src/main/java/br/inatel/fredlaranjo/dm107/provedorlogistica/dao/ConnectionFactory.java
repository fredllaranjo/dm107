package br.inatel.fredlaranjo.dm107.provedorlogistica.dao;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

import br.inatel.fredlaranjo.dm107.provedorlogistica.config.Constants;

/**
 * Manages the connection to the supplied endpoint
 * 
 * @author fredlaranjo
 *
 */
public final class ConnectionFactory {
	private ConnectionFactory() {}//prevent instantiation
	public static Connection getConnection() throws SQLException {
		return DriverManager.getConnection(Constants.DB_URL, Constants.DB_USER, Constants.DB_PASS);
	}
}
