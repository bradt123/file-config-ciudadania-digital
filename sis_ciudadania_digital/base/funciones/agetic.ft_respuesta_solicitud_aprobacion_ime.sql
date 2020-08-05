CREATE OR REPLACE FUNCTION agetic.ft_respuesta_solicitud_aprobacion_ime (
  p_administrador integer,
  p_id_usuario integer,
  p_tabla varchar,
  p_transaccion varchar
)
RETURNS varchar AS
$body$
/**************************************************************************
 SISTEMA:		Ciudadania Digital
 FUNCION: 		agetic.ft_respuesta_solicitud_aprobacion_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'agetic.trespuesta_solicitud_aprobacion'
 AUTOR: 		 (breydi.vasquez)
 FECHA:	        15-07-2020 15:03:33
 COMENTARIOS:
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				15-07-2020 15:03:33								Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'agetic.trespuesta_solicitud_aprobacion'	
 #
 ***************************************************************************/

DECLARE

	v_nro_requerimiento    	integer;
	v_parametros           	record;
	v_id_requerimiento     	integer;
	v_resp		            varchar;
	v_nombre_funcion        text;
	v_mensaje_error         text;
	v_id_respuesta_solicitud	integer;

BEGIN

    v_nombre_funcion = 'agetic.ft_respuesta_solicitud_aprobacion_ime';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************
 	#TRANSACCION:  'AGETIC_RESOLAPB_INS'
 	#DESCRIPCION:	Insercion de registros
 	#AUTOR:		breydi.vasquez
 	#FECHA:		15-07-2020 15:03:33
	***********************************/

	if(p_transaccion='AGETIC_RESOLAPB_INS')then

        begin

        	--Sentencia de la insercion
        	insert into agetic.trespuesta_solicitud_aprobacion(
			estado_reg,
			finalizado,
			estado,
			mensaje,
			link_verificacion,
			link_verificacion_unico,
			transaction_code,
			request_uuid,
			redirect_uri,
            uuid_blockchain,
			id_notificacion_solicitud,
			id_usuario_reg,
			fecha_reg,
			id_usuario_ai,
			usuario_ai,
			id_usuario_mod,
			fecha_mod
          	) values(
			'activo',
			coalesce(v_parametros.finalizado, false),
			coalesce(v_parametros.estado,false),
			v_parametros.mensaje,
			v_parametros.link_verificacion,
			v_parametros.link_verificacion_unico,
			v_parametros.transaction_code,
			v_parametros.request_uuid,
			v_parametros.redirect_uri,
            v_parametros.uuid_blockchain,
            1,
			--v_parametros.id_notificacion_solicitud,
			p_id_usuario,
			now(),
			v_parametros._id_usuario_ai,
			v_parametros._nombre_usuario_ai,
			null,
			null



			)RETURNING id_respuesta_solicitud into v_id_respuesta_solicitud;

			--Definicion de la respuesta
			v_resp = pxp.f_agrega_clave(v_resp,'mensaje','respuesta solicitud aprobación  almacenado(a) con exito (id_respuesta_solicitud'||v_id_respuesta_solicitud||')');
        	v_resp = pxp.f_agrega_clave(v_resp,'status','exito');
            v_resp = pxp.f_agrega_clave(v_resp,'msg','registro exitoso');
            v_resp = pxp.f_agrega_clave(v_resp,'id_respuesta_solicitud',v_id_respuesta_solicitud::varchar);


            --Devuelve la respuesta
            return v_resp;

		end;

	/*********************************
 	#TRANSACCION:  'AGETIC_RESOLAPB_MOD'
 	#DESCRIPCION:	Modificacion de registros
 	#AUTOR:		breydi.vasquez
 	#FECHA:		15-07-2020 15:03:33
	***********************************/

	elsif(p_transaccion='AGETIC_RESOLAPB_MOD')then

		begin
			--Sentencia de la modificacion
			update agetic.trespuesta_solicitud_aprobacion set
			finalizado = v_parametros.finalizado,
			estado = v_parametros.estado,
			mensaje = v_parametros.mensaje,
			link_verificacion = v_parametros.link_verificacion,
			link_verificacion_unico = v_parametros.link_verificacion_unico,
			transaction_code = v_parametros.transaction_code,
			request_uuid = v_parametros.request_uuid,
			redirect_uri = v_parametros.redirect_uri,
            uuid_blockchain = v_parametros.uuid_blockchain,
			id_notificacion_solicitud = v_parametros.id_notificacion_solicitud,
			id_usuario_mod = p_id_usuario,
			fecha_mod = now(),
			id_usuario_ai = v_parametros._id_usuario_ai,
			usuario_ai = v_parametros._nombre_usuario_ai
			where id_respuesta_solicitud=v_parametros.id_respuesta_solicitud;

			--Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','respuesta solicitud aprobación  modificado(a)');
            v_resp = pxp.f_agrega_clave(v_resp,'id_respuesta_solicitud',v_parametros.id_respuesta_solicitud::varchar);

            --Devuelve la respuesta
            return v_resp;

		end;

	/*********************************
 	#TRANSACCION:  'AGETIC_RESOLAPB_ELI'
 	#DESCRIPCION:	Eliminacion de registros
 	#AUTOR:		breydi.vasquez
 	#FECHA:		15-07-2020 15:03:33
	***********************************/

	elsif(p_transaccion='AGETIC_RESOLAPB_ELI')then

		begin
			--Sentencia de la eliminacion
			delete from agetic.trespuesta_solicitud_aprobacion
            where id_respuesta_solicitud=v_parametros.id_respuesta_solicitud;

            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','respuesta solicitud aprobación  eliminado(a)');
            v_resp = pxp.f_agrega_clave(v_resp,'id_respuesta_solicitud',v_parametros.id_respuesta_solicitud::varchar);

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

ALTER FUNCTION agetic.ft_respuesta_solicitud_aprobacion_ime (p_administrador integer, p_id_usuario integer, p_tabla varchar, p_transaccion varchar)
  OWNER TO postgres;
