package br.inatel.fredlaranjo.dm107.provedorlogistica.auth;

import java.io.IOException;
import java.util.Base64;
import java.util.Objects;

import br.inatel.fredlaranjo.dm107.provedorlogistica.dao.UserDao;

public class AuthenticationService {

	private UserDao userDao = new UserDao();

	public boolean authenticate(String credentials) {
		if (Objects.isNull(credentials)) {
			return false;
		}

		final String encoded = credentials.replaceFirst("Basic ", "");

		String userAndPass = null;

		boolean authenticationStatus = false;
		try {
			byte[] decodedBytes = Base64.getDecoder().decode(encoded);
			userAndPass = new String(decodedBytes, "UTF-8");
			final String userAndPassSplit[] = userAndPass.split(":");
			final String user = userAndPassSplit[0];
			final String pass = userAndPassSplit[1];

			authenticationStatus = userDao.userExists(user, pass);
		} catch (IOException e) {
			e.printStackTrace();
		}

		return authenticationStatus;
	}

}
