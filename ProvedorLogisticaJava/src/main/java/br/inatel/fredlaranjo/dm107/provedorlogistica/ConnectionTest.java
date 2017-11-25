package br.inatel.fredlaranjo.dm107.provedorlogistica;

import java.sql.ResultSet;
import java.sql.SQLException;

import br.inatel.fredlaranjo.dm107.provedorlogistica.dao.ConnectionFactory;

/**
 * Only used for database connection tests purposes.
 * 
 * @author fredlaranjo
 *
 */
public class ConnectionTest {
	public static void main(String[] args) {
		ResultSet rs;
		try {
			rs = ConnectionFactory.getConnection().prepareStatement("show tables").executeQuery();
			while (rs.next()) {
				String s = rs.getString(1);
				System.out.println(s);
			}
		} catch (SQLException e) {
			e.printStackTrace();
		}
	}
}
