CREATE OR REPLACE FUNCTION agetic.ft_datos_enviados_cdig_sel (
  p_administrador integer,
  p_id_usuario integer,
  p_tabla varchar,
  p_transaccion varchar
)
RETURNS varchar AS
$body$
/**************************************************************************
 SISTEMA:		Aprobacion de documentos ciudadania digital
 FUNCION: 		agetic.ft_atos_enviados_cdig_sel
 DESCRIPCION:   Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'agetic.datos_enviados_cdig'
 AUTOR: 		 (breydi.vasquez)
 FECHA:	        30-06-2020 16:16:10
 COMENTARIOS:
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				30-06-2020 16:16:10								Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'agetic.datos_enviados_cdig'
 #
 ***************************************************************************/

DECLARE

	v_consulta    		varchar;
	v_parametros  		record;
	v_nombre_funcion   	text;
	v_resp				varchar;

BEGIN

	v_nombre_funcion = 'agetic.ft_atos_enviados_cdig_sel';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************
 	#TRANSACCION:  'AGETIC_DENVAPD_SEL'
 	#DESCRIPCION:	Consulta de datos
 	#AUTOR:		breydi.vasquez
 	#FECHA:		30-06-2020 16:16:10
	***********************************/

	if(p_transaccion='AGETIC_DENVAPD_SEL')then

    	begin
    		--Sentencia de la consulta
			v_consulta:='select
						denvapd.id_dato_enviado,
						denvapd.estado_reg,
						denvapd.id_tramite,
						denvapd.access_token_usado,
						denvapd.tipo_documento,
						denvapd.documento,
						denvapd.tamanio_documento,
						denvapd.descripcion,
						denvapd.hash_documento,
						denvapd.id_documento,
						denvapd.id_gestion,
						denvapd.id_usuario_reg,
						denvapd.fecha_reg,
						denvapd.id_usuario_ai,
						denvapd.usuario_ai,
						denvapd.id_usuario_mod,
						denvapd.fecha_mod,
						usu1.cuenta as usr_reg,
						usu2.cuenta as usr_mod
						from agetic.datos_enviados_cdig denvapd
						inner join segu.tusuario usu1 on usu1.id_usuario = denvapd.id_usuario_reg
						left join segu.tusuario usu2 on usu2.id_usuario = denvapd.id_usuario_mod
				        where  ';

			--Definicion de la respuesta
			v_consulta:=v_consulta||v_parametros.filtro;
			v_consulta:=v_consulta||' order by ' ||v_parametros.ordenacion|| ' ' || v_parametros.dir_ordenacion || ' limit ' || v_parametros.cantidad || ' offset ' || v_parametros.puntero;

			--Devuelve la respuesta
			return v_consulta;

		end;

	/*********************************
 	#TRANSACCION:  'AGETIC_DENVAPD_CONT'
 	#DESCRIPCION:	Conteo de registros
 	#AUTOR:		breydi.vasquez
 	#FECHA:		30-06-2020 16:16:10
	***********************************/

	elsif(p_transaccion='AGETIC_DENVAPD_CONT')then

		begin
			--Sentencia de la consulta de conteo de registros
			v_consulta:='select count(id_dato_enviado)
					    from agetic.datos_enviados_cdig denvapd
					    inner join segu.tusuario usu1 on usu1.id_usuario = denvapd.id_usuario_reg
						left join segu.tusuario usu2 on usu2.id_usuario = denvapd.id_usuario_mod
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

ALTER FUNCTION agetic.ft_datos_enviados_cdig_sel (p_administrador integer, p_id_usuario integer, p_tabla varchar, p_transaccion varchar)
  OWNER TO postgres;
