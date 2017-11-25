package br.inatel.fredlaranjo.dm107.provedorlogistica.dao;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

import br.inatel.fredlaranjo.dm107.provedorlogistica.model.EntregaModel;

public class EntregaDao {

	private static final String INSERT_ENTREGA = "INSERT INTO entrega(num_pedido, id_cliente, nome_recebedor, cpf_recebedor, data_hora_entrega) VALUES(?, ?, ?, ?, ?);";
	private static final String SELECT_ENTREGA = "SELECT * FROM entrega WHERE num_pedido = ?;";

	public void insertEntrega(EntregaModel entrega) throws SQLException {
		try (Connection connection = ConnectionFactory.getConnection();
				PreparedStatement pstmt = connection.prepareStatement(INSERT_ENTREGA)) {
			pstmt.setLong(1, entrega.getNumPedido());
			pstmt.setLong(2, entrega.getIdCliente());
			pstmt.setString(3, entrega.getNomeRecebedor());
			pstmt.setString(4, entrega.getCpfRecebedor());
			pstmt.setString(5, entrega.getDataHoraEntrega());

			pstmt.executeUpdate();
		}
	}

	public EntregaModel selectEntrega(int numPedido) throws SQLException {
		EntregaModel entrega = null;

		try (Connection connection = ConnectionFactory.getConnection();
				PreparedStatement pstmt = connection.prepareStatement(SELECT_ENTREGA)) {
			pstmt.setInt(1, numPedido);

			try (ResultSet rs = pstmt.executeQuery()) {
				while (rs.next()) {
					Integer id = rs.getInt(1);
					Long num = rs.getLong(2);
					Long idCiente = rs.getLong(3);
					String nomeRecebedor = rs.getString(4);
					String cpfRecebedor = rs.getString(5);
					String dataEntrega = rs.getString(6);
					entrega = new EntregaModel(id, num, idCiente, nomeRecebedor, cpfRecebedor, dataEntrega);
				}
			}
		}

		return entrega;
	}

}
