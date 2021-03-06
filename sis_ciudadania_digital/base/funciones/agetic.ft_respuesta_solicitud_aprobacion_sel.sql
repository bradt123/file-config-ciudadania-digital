CREATE OR REPLACE FUNCTION agetic.ft_respuesta_solicitud_aprobacion_sel (
  p_administrador integer,
  p_id_usuario integer,
  p_tabla varchar,
  p_transaccion varchar
)
RETURNS varchar AS
$body$
/**************************************************************************
 SISTEMA:		Ciudadania Digital
 FUNCION: 		agetic.ft_respuesta_solicitud_aprobacion_sel
 DESCRIPCION:   Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'agetic.trespuesta_solicitud_aprobacion'
 AUTOR: 		 (breydi.vasquez)
 FECHA:	        15-07-2020 15:03:33
 COMENTARIOS:
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				15-07-2020 15:03:33								Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'agetic.trespuesta_solicitud_aprobacion'
 #
 ***************************************************************************/

DECLARE

	v_consulta    		varchar;
	v_parametros  		record;
	v_nombre_funcion   	text;
	v_resp				varchar;

BEGIN

	v_nombre_funcion = 'agetic.ft_respuesta_solicitud_aprobacion_sel';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************
 	#TRANSACCION:  'AGETIC_RESOLAPB_SEL'
 	#DESCRIPCION:	Consulta de datos
 	#AUTOR:		breydi.vasquez
 	#FECHA:		15-07-2020 15:03:33
	***********************************/

	if(p_transaccion='AGETIC_RESOLAPB_SEL')then

    	begin
    		--Sentencia de la consulta
			v_consulta:='select
						resolapb.id_respuesta_solicitud,
						resolapb.estado_reg,
						resolapb.finalizado,
						resolapb.estado,
						resolapb.mensaje,
						resolapb.link_verificacion,
						resolapb.link_verificacion_unico,
						resolapb.transaction_code,
						resolapb.request_uuid,
						resolapb.redirect_uri,
						resolapb.id_notificacion_solicitud,
						resolapb.id_usuario_reg,
						resolapb.fecha_reg,
						resolapb.id_usuario_ai,
						resolapb.usuario_ai,
						resolapb.id_usuario_mod,
						resolapb.fecha_mod,
						usu1.cuenta as usr_reg,
						usu2.cuenta as usr_mod
						from agetic.trespuesta_solicitud_aprobacion resolapb
						inner join segu.tusuario usu1 on usu1.id_usuario = resolapb.id_usuario_reg
						left join segu.tusuario usu2 on usu2.id_usuario = resolapb.id_usuario_mod
				        where  ';

			--Definicion de la respuesta
			v_consulta:=v_consulta||v_parametros.filtro;
			v_consulta:=v_consulta||' order by ' ||v_parametros.ordenacion|| ' ' || v_parametros.dir_ordenacion || ' limit ' || v_parametros.cantidad || ' offset ' || v_parametros.puntero;

			--Devuelve la respuesta
			return v_consulta;

		end;

	/*********************************
 	#TRANSACCION:  'AGETIC_RESOLAPB_CONT'
 	#DESCRIPCION:	Conteo de registros
 	#AUTOR:		breydi.vasquez
 	#FECHA:		15-07-2020 15:03:33
	***********************************/

	elsif(p_transaccion='AGETIC_RESOLAPB_CONT')then

		begin
			--Sentencia de la consulta de conteo de registros
			v_consulta:='select count(id_respuesta_solicitud)
					    from agetic.trespuesta_solicitud_aprobacion resolapb
					    inner join segu.tusuario usu1 on usu1.id_usuario = resolapb.id_usuario_reg
						left join segu.tusuario usu2 on usu2.id_usuario = resolapb.id_usuario_mod
					    where ';

			--Definicion de la respuesta
			v_consulta:=v_consulta||v_parametros.filtro;

			--Devuelve la respuesta
			return v_consulta;

		end;

	else

		raise exception 'Transaccion inexistente';

	end if;

EXCEPTION

	WHEN OTHERS THEN
			v_resp='';
			v_resp = pxp.f_agrega_clave(v_resp,'mensaje',SQLERRM);
			v_resp = pxp.f_agrega_clave(v_resp,'codigo_error',SQLSTATE);
			v_resp = pxp.f_agrega_clave(v_resp,'procedimientos',v_nombre_funcion);
			raise exception '%',v_resp;
END;
$body$
LANGUAGE 'plpgsql'
VOLATILE
CALLED ON NULL INPUT
SECURITY INVOKER
COST 100;

ALTER FUNCTION agetic.ft_respuesta_solicitud_aprobacion_sel (p_administrador integer, p_id_usuario integer, p_tabla varchar, p_transaccion varchar)
  OWNER TO postgres;
