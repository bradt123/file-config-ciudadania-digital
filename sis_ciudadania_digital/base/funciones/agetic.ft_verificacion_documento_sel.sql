CREATE OR REPLACE FUNCTION agetic.ft_verificacion_documento_sel (
  p_administrador integer,
  p_id_usuario integer,
  p_tabla varchar,
  p_transaccion varchar
)
RETURNS varchar AS
$body$
/**************************************************************************
 SISTEMA:		Ciudadania Digital
 FUNCION: 		agetic.ft_verificacion_documento_sel
 DESCRIPCION:   Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'agetic.tverificacion_documento'
 AUTOR: 		 (breydi.vasquez)
 FECHA:	        15-07-2020 15:03:27
 COMENTARIOS:
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				15-07-2020 15:03:27								Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'agetic.tverificacion_documento'
 #
 ***************************************************************************/

DECLARE

	v_consulta    		varchar;
	v_parametros  		record;
	v_nombre_funcion   	text;
	v_resp				varchar;


    v_registros_data			varchar;
    v_values					varchar;
    v_nombre 					varchar;
    v_1_apellido				varchar;
    v_2_apellido				varchar;
    v_registros_json			record;

BEGIN

	v_nombre_funcion = 'agetic.ft_verificacion_documento_sel';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************
 	#TRANSACCION:  'AGETIC_VERFDOC_SEL'
 	#DESCRIPCION:	Consulta de datos
 	#AUTOR:		breydi.vasquez
 	#FECHA:		15-07-2020 15:03:27
	***********************************/

	if(p_transaccion='AGETIC_VERFDOC_SEL')then

    	begin
    		--Sentencia de la consulta
			v_consulta:='select
						verfdoc.id_verificacion_documento,
						verfdoc.estado_reg,
						verfdoc.documento,
						verfdoc.id_tramite,
						verfdoc.tipo_documento,
                        verfdoc.transaction_id,
						verfdoc.id_gestion,
						verfdoc.id_periodo,
						verfdoc.id_usuario_reg,
						verfdoc.fecha_reg,
						verfdoc.id_usuario_ai,
						verfdoc.usuario_ai,
						verfdoc.id_usuario_mod,
						verfdoc.fecha_mod,
						usu1.cuenta as usr_reg,
						usu2.cuenta as usr_mod,
                        ges.gestion,
					    param.f_literal_periodo(per.id_periodo) as mes
						from agetic.tverificacion_documento verfdoc
						inner join segu.tusuario usu1 on usu1.id_usuario = verfdoc.id_usuario_reg
						left join segu.tusuario usu2 on usu2.id_usuario = verfdoc.id_usuario_mod
                        inner join param.tgestion ges on ges.id_gestion = verfdoc.id_gestion
                        inner join param.tperiodo per on per.id_periodo = verfdoc.id_periodo
				        where  ';


			--Definicion de la respuesta
			v_consulta:=v_consulta||v_parametros.filtro;
			v_consulta:=v_consulta||' order by ' ||v_parametros.ordenacion|| ' ' || v_parametros.dir_ordenacion || ' limit ' || v_parametros.cantidad || ' offset ' || v_parametros.puntero;

			--Devuelve la respuesta
			return v_consulta;

		end;

	/*********************************
 	#TRANSACCION:  'AGETIC_VERFDOC_CONT'
 	#DESCRIPCION:	Conteo de registros
 	#AUTOR:		breydi.vasquez
 	#FECHA:		15-07-2020 15:03:27
	***********************************/

	elsif(p_transaccion='AGETIC_VERFDOC_CONT')then

		begin
			--Sentencia de la consulta de conteo de registros
			v_consulta:='select count(id_verificacion_documento)
					    from agetic.tverificacion_documento verfdoc
					    inner join segu.tusuario usu1 on usu1.id_usuario = verfdoc.id_usuario_reg
						left join segu.tusuario usu2 on usu2.id_usuario = verfdoc.id_usuario_mod
					    where ';

			--Definicion de la respuesta
			v_consulta:=v_consulta||v_parametros.filtro;

			--Devuelve la respuesta
			return v_consulta;

		end;

	/*********************************
 	#TRANSACCION:  'AGETIC_REGDVEF_SEL'
 	#DESCRIPCION:	Consulta de datos verificacion documento
 	#AUTOR:		breydi.vasquez
 	#FECHA:		29-07-2020
	***********************************/

	elsif(p_transaccion='AGETIC_REGDVEF_SEL')then

    	begin

        v_registros_data = v_parametros.registros:: JSON->>'registros';
/*        	raise 'data: %',v_registros_data;*/


        	create temp table registro_datos_verificacion(
              fecha_solicitud			varchar,
              nombres					varchar,
              primer_apellido			varchar,
              segundo_apellido			varchar,
              descripcion				varchar,
              fecha_reg					varchar
            ) on commit drop;

	       	--Sentencia de la insercion
            for v_registros_json in SELECT json_array_elements(v_registros_data :: JSON) loop

            	v_values   = v_registros_json.json_array_elements::json;

            	insert into registro_datos_verificacion(
                    fecha_solicitud,
                    nombres,
                    primer_apellido,
                    segundo_apellido,
                    descripcion,
                    fecha_reg
                ) values(
                    v_values::json->>'fechaSolicitud',
                    v_values::json->>'nombres',
                    v_values::json->>'primer_apellido',
                    v_values::json->>'segundo_apellido',
					v_values::json->>'descripcion',
					v_values::json->>'timestamp'
                );
            end loop;
    		--Sentencia de la consulta
			v_consulta:='select
						fecha_solicitud,
                        nombres,
                        primer_apellido,
                        segundo_apellido,
						descripcion,
						fecha_reg
						from registro_datos_verificacion
                        where  ';


			--Definicion de la respuesta
			v_consulta:=v_consulta||v_parametros.filtro;
			v_consulta:=v_consulta||' order by ' ||v_parametros.ordenacion|| ' ' || v_parametros.dir_ordenacion || ' limit ' || v_parametros.cantidad || ' offset ' || v_parametros.puntero;

			--Devuelve la respuesta
			return v_consulta;

		end;

	/*********************************
 	#TRANSACCION:  'AGETIC_REGDVEF_CONT'
 	#DESCRIPCION:	Conteo de registros
 	#AUTOR:		breydi.vasquez
 	#FECHA:		29-07-2020
	***********************************/
/*
	elsif(p_transaccion='AGETIC_REGDVEF_CONT')then

		begin
			--Sentencia de la consulta de conteo de registros
			v_consulta:='select count(regdvf.id_verificacion_registro)
					    from agetic.tregistro_datos_verificacion regdvf
					    where ';

			--Definicion de la respuesta
			v_consulta:=v_consulta||v_parametros.filtro;

			--Devuelve la respuesta
			return v_consulta;

		end;   */

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

ALTER FUNCTION agetic.ft_verificacion_documento_sel (p_administrador integer, p_id_usuario integer, p_tabla varchar, p_transaccion varchar)
  OWNER TO postgres;
