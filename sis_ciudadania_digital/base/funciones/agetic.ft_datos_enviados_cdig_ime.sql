CREATE OR REPLACE FUNCTION agetic.ft_datos_enviados_cdig_ime (
  p_administrador integer,
  p_id_usuario integer,
  p_tabla varchar,
  p_transaccion varchar
)
RETURNS varchar AS
$body$
/**************************************************************************
 SISTEMA:		Aprobacion de documentos ciudadania digital
 FUNCION: 		agetic.ft_atos_enviados_cdig_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'agetic.datos_enviados_cdig'
 AUTOR: 		 (breydi.vasquez)
 FECHA:	        30-06-2020 16:16:10
 COMENTARIOS:
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				30-06-2020 16:16:10								Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'agetic.datos_enviados_cdig'
 #
 ***************************************************************************/

DECLARE

	v_nro_requerimiento    	integer;
	v_parametros           	record;
	v_id_requerimiento     	integer;
	v_resp		            varchar;
	v_nombre_funcion        text;
	v_mensaje_error         text;
	v_id_dato_enviado	integer;

    v_token_interop			varchar;
    v_access_token			varchar;

BEGIN

    v_nombre_funcion = 'agetic.ft_atos_enviados_cdig_ime';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************
 	#TRANSACCION:  'AGETIC_DENVAPD_INS'
 	#DESCRIPCION:	Insercion de registros
 	#AUTOR:		breydi.vasquez
 	#FECHA:		30-06-2020 16:16:10
	***********************************/

	if(p_transaccion='AGETIC_DENVAPD_INS')then

        begin

        	--Sentencia de la insercion
        	insert into agetic.tdatos_enviados_cdig(
			estado_reg,
			id_tramite,
			access_token_usado,
			tipo_documento,
			documento,
			id_estado_wf,
			descripcion,
			hash_documento,
/*			id_documento,*/
/*			id_gestion,*/
			id_usuario_reg,
			fecha_reg,
			id_usuario_ai,
			usuario_ai,
			id_usuario_mod,
			fecha_mod
          	) values(
			'activo',
			v_parametros.id_tramite,
			v_parametros.access_token_usado,
			v_parametros.tipo_documento,
			v_parametros.documento,
			v_parametros.id_estado_wf,
			v_parametros.descripcion,
			v_parametros.hash_documento,
/*			v_parametros.id_documento,*/
/*			v_parametros.id_gestion,*/
			p_id_usuario,
			now(),
			v_parametros._id_usuario_ai,
			v_parametros._nombre_usuario_ai,
			null,
			null



			)RETURNING id_dato_enviado into v_id_dato_enviado;

			--Definicion de la respuesta
			v_resp = pxp.f_agrega_clave(v_resp,'mensaje','datos enviados para aprobacion almacenado(a) con exito (id_dato_enviado'||v_id_dato_enviado||')');
            v_resp = pxp.f_agrega_clave(v_resp,'id_dato_enviado',v_id_dato_enviado::varchar);

            --Devuelve la respuesta
            return v_resp;

		end;

	/*********************************
 	#TRANSACCION:  'AGETIC_DENVAPD_MOD'
 	#DESCRIPCION:	Modificacion de registros
 	#AUTOR:		breydi.vasquez
 	#FECHA:		30-06-2020 16:16:10
	***********************************/

	elsif(p_transaccion='AGETIC_DENVAPD_MOD')then

		begin
			--Sentencia de la modificacion
			update agetic.tdatos_enviados_cdig set
			id_tramite = v_parametros.id_tramite,
			access_token_usado = v_parametros.access_token_usado,
			tipoDocumento = v_parametros.tipo_documento,
			documento = v_parametros.documento,
			tamanio_documento = v_parametros.tamanio_documento,
			descripcion = v_parametros.descripcion,
			hash_documento = v_parametros.hash_documento,
			id_documento = v_parametros.id_documento,
			id_gestion = v_parametros.id_gestion,
			id_usuario_mod = p_id_usuario,
			fecha_mod = now(),
			id_usuario_ai = v_parametros._id_usuario_ai,
			usuario_ai = v_parametros._nombre_usuario_ai
			where id_dato_enviado=v_parametros.id_dato_enviado;

			--Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','datos enviados para aprobacion modificado(a)');
            v_resp = pxp.f_agrega_clave(v_resp,'id_dato_enviado',v_parametros.id_dato_enviado::varchar);

            --Devuelve la respuesta
            return v_resp;

		end;

	/*********************************
 	#TRANSACCION:  'AGETIC_DENVAPD_ELI'
 	#DESCRIPCION:	Eliminacion de registros
 	#AUTOR:		breydi.vasquez
 	#FECHA:		30-06-2020 16:16:10
	***********************************/

	elsif(p_transaccion='AGETIC_DENVAPD_ELI')then

		begin
			--Sentencia de la eliminacion
			delete from agetic.tdatos_enviados_cdig
            where id_dato_enviado=v_parametros.id_dato_enviado;

            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','datos enviados para aprobacion eliminado(a)');
            v_resp = pxp.f_agrega_clave(v_resp,'id_dato_enviado',v_parametros.id_dato_enviado::varchar);

            --Devuelve la respuesta
            return v_resp;

		end;


	/*********************************
 	#TRANSACCION:  'AGETIC_GETOKENUSER_IME'
 	#DESCRIPCION:	Optener los tokens que usaria el usario para aprobacion de documentos
 	#AUTOR:		breydi.vasquez
 	#FECHA:		30-06-2020 16:16:10
	***********************************/

	elsif(p_transaccion='AGETIC_GETOKENUSER_IME')then

		begin
			select token_interoperabilidad, access_token
            	into v_token_interop, v_access_token
            from segu.tusuario
            where id_usuario = p_id_usuario;

            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'','');
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','datos de usuario que inicio sesion');
            v_resp = pxp.f_agrega_clave(v_resp,'access_token',v_access_token::varchar);
            v_resp = pxp.f_agrega_clave(v_resp,'token_interop',v_token_interop::varchar);

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

ALTER FUNCTION agetic.ft_datos_enviados_cdig_ime (p_administrador integer, p_id_usuario integer, p_tabla varchar, p_transaccion varchar)
  OWNER TO postgres;
