package br.inatel.fredlaranjo.dm107.provedorlogistica.dao;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

public class UserDao {

	private static final String SELECT_USER = "SELECT COUNT(id) FROM users " + "WHERE username = ? AND password = ?;";

	public boolean userExists(String user, String pwd) {
		boolean userExists = false;

		try (Connection connection = ConnectionFactory.getConnection();
				PreparedStatement pstmt = connection.prepareStatement(SELECT_USER)) {
			pstmt.setString(1, user);
			pstmt.setString(2, pwd);

			try (ResultSet rs = pstmt.executeQuery()) {
				int count = 0;

				while (rs.next()) {
					count = rs.getInt(1);
				}

				if (count == 1) {
					userExists = true;
				}
			}
		} catch (SQLException e) {
			userExists = false;
		}

		return userExists;
	}

}
