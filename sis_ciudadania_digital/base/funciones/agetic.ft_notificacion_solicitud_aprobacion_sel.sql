CREATE OR REPLACE FUNCTION agetic.ft_notificacion_solicitud_aprobacion_sel (
  p_administrador integer,
  p_id_usuario integer,
  p_tabla varchar,
  p_transaccion varchar
)
RETURNS varchar AS
$body$
/**************************************************************************
 SISTEMA:		Ciudadania Digital
 FUNCION: 		agetic.ft_notificacion_solicitud_aprobacion_sel
 DESCRIPCION:   Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'agetic.tnotificacion_solicitud_aprobacion'
 AUTOR: 		 (breydi.vasquez)
 FECHA:	        15-07-2020 15:03:30
 COMENTARIOS:
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				15-07-2020 15:03:30								Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'agetic.tnotificacion_solicitud_aprobacion'
 #
 ***************************************************************************/

DECLARE

	v_consulta    		varchar;
	v_parametros  		record;
	v_nombre_funcion   	text;
	v_resp				varchar;

BEGIN

	v_nombre_funcion = 'agetic.ft_notificacion_solicitud_aprobacion_sel';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************
 	#TRANSACCION:  'AGETIC_NTSOLAPB_SEL'
 	#DESCRIPCION:	Consulta de datos
 	#AUTOR:		breydi.vasquez
 	#FECHA:		15-07-2020 15:03:30
	***********************************/

	if(p_transaccion='AGETIC_NTSOLAPB_SEL')then

    	begin
    		--Sentencia de la consulta
			v_consulta:='select
						ntsolapb.id_notificacion_solicitud,
						ntsolapb.estado_reg,
                        ntsolapb.aceptado,
						ntsolapb.introducido,
						ntsolapb.request_uuid,
						ntsolapb.codigo_operacion,
						ntsolapb.mensaje,
						ntsolapb.transaction_id,
						ntsolapb.fecha_hora_solicitud,
						ntsolapb.hash_datos,
						ntsolapb.ci,
						ntsolapb.id_gestion,
						ntsolapb.id_periodo,
						ntsolapb.id_usuario_reg,
						ntsolapb.fecha_reg,
						ntsolapb.id_usuario_ai,
						ntsolapb.usuario_ai,
						ntsolapb.id_usuario_mod,
						ntsolapb.fecha_mod,
						usu1.cuenta as usr_reg,
						usu2.cuenta as usr_mod,
                        ges.gestion,
					    param.f_literal_periodo(per.id_periodo) as mes
						from agetic.tnotificacion_solicitud_aprobacion ntsolapb
						inner join segu.tusuario usu1 on usu1.id_usuario = ntsolapb.id_usuario_reg
						left join segu.tusuario usu2 on usu2.id_usuario = ntsolapb.id_usuario_mod
                        inner join param.tgestion ges on ges.id_gestion = ntsolapb.id_gestion
                        inner join param.tperiodo per on per.id_periodo = ntsolapb.id_periodo
				        where  ';

			--Definicion de la respuesta
			v_consulta:=v_consulta||v_parametros.filtro;
			v_consulta:=v_consulta||' order by ' ||v_parametros.ordenacion|| ' ' || v_parametros.dir_ordenacion || ' limit ' || v_parametros.cantidad || ' offset ' || v_parametros.puntero;

			--Devuelve la respuesta
			return v_consulta;

		end;

	/*********************************
 	#TRANSACCION:  'AGETIC_NTSOLAPB_CONT'
 	#DESCRIPCION:	Conteo de registros
 	#AUTOR:		breydi.vasquez
 	#FECHA:		15-07-2020 15:03:30
	***********************************/

	elsif(p_transaccion='AGETIC_NTSOLAPB_CONT')then

		begin
			--Sentencia de la consulta de conteo de registros
			v_consulta:='select count(id_notificacion_solicitud)
					    from agetic.tnotificacion_solicitud_aprobacion ntsolapb
					    inner join segu.tusuario usu1 on usu1.id_usuario = ntsolapb.id_usuario_reg
						left join segu.tusuario usu2 on usu2.id_usuario = ntsolapb.id_usuario_mod
                        inner join param.tgestion ges on ges.id_gestion = ntsolapb.id_gestion
                        inner join param.tperiodo per on per.id_periodo = ntsolapb.id_periodo
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

ALTER FUNCTION agetic.ft_notificacion_solicitud_aprobacion_sel (p_administrador integer, p_id_usuario integer, p_tabla varchar, p_transaccion varchar)
  OWNER TO postgres;
