CREATE OR REPLACE FUNCTION agetic.ft_verificacion_documento_ime (
  p_administrador integer,
  p_id_usuario integer,
  p_tabla varchar,
  p_transaccion varchar
)
RETURNS varchar AS
$body$
/**************************************************************************
 SISTEMA:		Ciudadania Digital
 FUNCION: 		agetic.ft_verificacion_documento_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'agetic.tverificacion_documento'
 AUTOR: 		 (breydi.vasquez)
 FECHA:	        15-07-2020 15:03:27
 COMENTARIOS:
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				15-07-2020 15:03:27								Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'agetic.tverificacion_documento'
 #
 ***************************************************************************/

DECLARE

	v_nro_requerimiento    	integer;
	v_parametros           	record;
	v_id_requerimiento     	integer;
	v_resp		            varchar;
	v_nombre_funcion        text;
	v_mensaje_error         text;
	v_id_verificacion_documento	integer;
    v_id_periodo				integer;
    v_id_gestion				integer;


BEGIN

    v_nombre_funcion = 'agetic.ft_verificacion_documento_ime';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************
 	#TRANSACCION:  'AGETIC_VERFDOC_INS'
 	#DESCRIPCION:	Insercion de registros
 	#AUTOR:		breydi.vasquez
 	#FECHA:		15-07-2020 15:03:27
	***********************************/

	if(p_transaccion='AGETIC_VERFDOC_INS')then

        begin
             select id_periodo, id_gestion
              into v_id_periodo, v_id_gestion
              from param.tperiodo
              where now()::date between fecha_ini and fecha_fin;

        	--Sentencia de la insercion
        	insert into agetic.tverificacion_documento(
			estado_reg,
			documento,
			id_tramite,
			tipo_documento,
			id_gestion,
            id_periodo,
            id_notificacion_solicitud,
            transaction_id,
			id_usuario_reg,
			fecha_reg,
			id_usuario_ai,
			usuario_ai,
			id_usuario_mod,
			fecha_mod
          	) values(
			'activo',
			v_parametros.documento,
			v_parametros.id_tramite,
			v_parametros.tipo_documento,
            v_parametros.id_gestion,
			v_parametros.id_periodo,
            v_parametros.id_notificacion_solicitud,
            v_parametros.transaction_id,
			p_id_usuario,
			now(),
			v_parametros._id_usuario_ai,
			v_parametros._nombre_usuario_ai,
			null,
			null



			)RETURNING id_verificacion_documento into v_id_verificacion_documento;

			--Definicion de la respuesta
			v_resp = pxp.f_agrega_clave(v_resp,'mensaje','verificación documento aprobación almacenado(a) con exito (id_verificacion_documento '||v_id_verificacion_documento||')');
            v_resp = pxp.f_agrega_clave(v_resp,'msg', 'success'::varchar);
            v_resp = pxp.f_agrega_clave(v_resp,'id_verificacion_documento',v_id_verificacion_documento::varchar);

            --Devuelve la respuesta
            return v_resp;

		end;

	/*********************************
 	#TRANSACCION:  'AGETIC_VERFDOC_MOD'
 	#DESCRIPCION:	Modificacion de registros
 	#AUTOR:		breydi.vasquez
 	#FECHA:		15-07-2020 15:03:27
	***********************************/

	elsif(p_transaccion='AGETIC_VERFDOC_MOD')then

		begin
			--Sentencia de la modificacion
			update agetic.tverificacion_documento set
			id_documento = v_parametros.id_documento,
			verificacion_correcta = v_parametros.verificacion_correcta,
			tipo_verificacion = v_parametros.tipo_verificacion,
			registro = v_parametros.registro,
			id_gestion = v_parametros.id_gestion,
			id_usuario_mod = p_id_usuario,
			fecha_mod = now(),
			id_usuario_ai = v_parametros._id_usuario_ai,
			usuario_ai = v_parametros._nombre_usuario_ai
			where id_verificacion_documento=v_parametros.id_verificacion_documento;

			--Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','verificación documento aprobación modificado(a)');
            v_resp = pxp.f_agrega_clave(v_resp,'id_verificacion_documento',v_parametros.id_verificacion_documento::varchar);

            --Devuelve la respuesta
            return v_resp;

		end;

	/*********************************
 	#TRANSACCION:  'AGETIC_VERFDOC_ELI'
 	#DESCRIPCION:	Eliminacion de registros
 	#AUTOR:		breydi.vasquez
 	#FECHA:		15-07-2020 15:03:27
	***********************************/

	elsif(p_transaccion='AGETIC_VERFDOC_ELI')then

		begin
			--Sentencia de la eliminacion
			delete from agetic.tverificacion_documento
            where id_verificacion_documento=v_parametros.id_verificacion_documento;

            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','verificación documento aprobación eliminado(a)');
            v_resp = pxp.f_agrega_clave(v_resp,'id_verificacion_documento',v_parametros.id_verificacion_documento::varchar);

            --Devuelve la respuesta
            return v_resp;

		end;

	else

    	raise exception 'Transaccion inexistente: %',p_transaccion;

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

ALTER FUNCTION agetic.ft_verificacion_documento_ime (p_administrador integer, p_id_usuario integer, p_tabla varchar, p_transaccion varchar)
  OWNER TO postgres;
