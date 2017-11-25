package br.inatel.fredlaranjo.dm107.provedorlogistica.service;

import java.sql.SQLException;
import java.util.Objects;

import javax.ws.rs.Consumes;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.PathParam;
import javax.ws.rs.Produces;
import javax.ws.rs.core.Context;
import javax.ws.rs.core.MediaType;
import javax.ws.rs.core.Response;
import javax.ws.rs.core.Response.Status;
import javax.ws.rs.core.UriInfo;

import br.inatel.fredlaranjo.dm107.provedorlogistica.dao.EntregaDao;
import br.inatel.fredlaranjo.dm107.provedorlogistica.model.EntregaModel;

@Path("/entrega")
public class EntregaService {

	private EntregaDao entregaDao = new EntregaDao();

	@Context
	private UriInfo uriInfo;

	@POST
	@Consumes(MediaType.APPLICATION_JSON)
	@Produces(MediaType.APPLICATION_JSON)
	public Response createEntrega(EntregaModel entrega) {
		if (Objects.isNull(entrega.getIdCliente()) || Objects.isNull(entrega.getNumPedido())) {
			return Response.status(Status.BAD_REQUEST).build();
		}

		try {
			entregaDao.insertEntrega(entrega);

			return Response
					.created(uriInfo.getAbsolutePathBuilder().path(String.valueOf(entrega.getNumPedido())).build())
					.build();
		} catch (SQLException e) {
			return Response.serverError().build();
		}
	}

	@GET
	@Produces(MediaType.APPLICATION_JSON)
	@Path("{numPedido}")
	public Response getEntrega(@PathParam("numPedido") int numPedido) {
		try {
			EntregaModel entrega = entregaDao.selectEntrega(numPedido);

			if (Objects.isNull(entrega)) {
				return Response.status(Status.NOT_FOUND).build();
			}

			return Response.ok(entrega).build();
		} catch (SQLException e) {
			return Response.serverError().build();
		}

	}

}
