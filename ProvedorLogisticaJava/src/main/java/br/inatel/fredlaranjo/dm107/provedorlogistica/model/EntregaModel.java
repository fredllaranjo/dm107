package br.inatel.fredlaranjo.dm107.provedorlogistica.model;

public class EntregaModel {

	private Integer id;
	private Long numPedido;
	private Long idCliente;
	private String nomeRecebedor;
	private String cpfRecebedor;
	private String dataHoraEntrega;

	public EntregaModel() {
	}

	public EntregaModel(Integer id, Long numPedido, Long idCliente, String nomeRecebedor, String cpfRecebedor,
			String dataHoraEntrega) {
		this.id = id;
		this.numPedido = numPedido;
		this.idCliente = idCliente;
		this.nomeRecebedor = nomeRecebedor;
		this.cpfRecebedor = cpfRecebedor;
		this.dataHoraEntrega = dataHoraEntrega;
	}

	public Integer getId() {
		return id;
	}

	public void setId(Integer id) {
		this.id = id;
	}

	public Long getNumPedido() {
		return numPedido;
	}

	public void setNumPedido(Long numPedido) {
		this.numPedido = numPedido;
	}

	public Long getIdCliente() {
		return idCliente;
	}

	public void setIdCliente(Long idCliente) {
		this.idCliente = idCliente;
	}

	public String getNomeRecebedor() {
		return nomeRecebedor;
	}

	public void setNomeRecebedor(String nomeRecebedor) {
		this.nomeRecebedor = nomeRecebedor;
	}

	public String getCpfRecebedor() {
		return cpfRecebedor;
	}

	public void setCpfRecebedor(String cpfRecebedor) {
		this.cpfRecebedor = cpfRecebedor;
	}

	public String getDataHoraEntrega() {
		return dataHoraEntrega;
	}

	public void setDataHoraEntrega(String dataHoraEntrega) {
		this.dataHoraEntrega = dataHoraEntrega;
	}


}
