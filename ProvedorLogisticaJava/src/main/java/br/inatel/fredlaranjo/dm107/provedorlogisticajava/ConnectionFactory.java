package br.inatel.fredlaranjo.dm107.provedorlogisticajava;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class ConnectionFactory {
	public Connection getConnection() {
		try {
			return DriverManager.getConnection("jdbc:mysql://localhost/provlog", "root", "root");
		} catch (SQLException e) {
			throw new RuntimeException(e);
		}
	}
}
