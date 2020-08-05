CREATE OR REPLACE FUNCTION agetic.ft_notificacion_solicitud_aprobacion_ime (
  p_administrador integer,
  p_id_usuario integer,
  p_tabla varchar,
  p_transaccion varchar
)
RETURNS varchar AS
$body$
/**************************************************************************
 SISTEMA:		Ciudadania Digital
 FUNCION: 		agetic.ft_notificacion_solicitud_aprobacion_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'agetic.tnotificacion_solicitud_aprobacion'
 AUTOR: 		 (breydi.vasquez)
 FECHA:	        15-07-2020 15:03:30
 COMENTARIOS:
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				15-07-2020 15:03:30								Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'agetic.tnotificacion_solicitud_aprobacion'
 #
 ***************************************************************************/

DECLARE

	v_nro_requerimiento    	integer;
	v_parametros           	record;
	v_id_requerimiento     	integer;
	v_resp		            varchar;
	v_nombre_funcion        text;
	v_mensaje_error         text;
	v_id_notificacion_solicitud	integer;
  	v_id_periodo			integer;
    v_id_gestion			integer;
	v_documento					varchar;
	v_tipo_documento			varchar;
    v_id_estado_wf				integer;

BEGIN

    v_nombre_funcion = 'agetic.ft_notificacion_solicitud_aprobacion_ime';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************
 	#TRANSACCION:  'AGETIC_NTSOLAPB_INS'
 	#DESCRIPCION:	Insercion de registros
 	#AUTOR:		breydi.vasquez
 	#FECHA:		15-07-2020 15:03:30
	***********************************/

	if(p_transaccion='AGETIC_NTSOLAPB_INS')then

        begin
        	-- captura gestion y periodo
            	select id_periodo, id_gestion
                into v_id_periodo, v_id_gestion
                from param.tperiodo
                where now()::date between fecha_ini and fecha_fin;

        	--Sentencia de la insercion
        	insert into agetic.tnotificacion_solicitud_aprobacion(
			estado_reg,
			aceptado,
			introducido,
			request_uuid,
			codigo_operacion,
			mensaje,
			transaction_id,
			fecha_hora_solicitud,
			hash_datos,
			ci,
			id_gestion,
			id_periodo,
			id_usuario_reg,
			fecha_reg,
			id_usuario_ai,
			usuario_ai,
			id_usuario_mod,
			fecha_mod
          	) values(
			'activo',
			coalesce(v_parametros.aceptado, false),
			coalesce(v_parametros.introducido, false),
			v_parametros.request_uuid,
			v_parametros.codigo_operacion,
			v_parametros.mensaje,
			v_parametros.transaction_id,
			v_parametros.fecha_hora_solicitud,
			v_parametros.hash_datos,
			v_parametros.ci,
			v_id_gestion,
			v_id_periodo,
			p_id_usuario,
			now(),
			v_parametros._id_usuario_ai,
			v_parametros._nombre_usuario_ai,
			null,
			null



			)RETURNING id_notificacion_solicitud into v_id_notificacion_solicitud;


            if (v_id_notificacion_solicitud is not null  and v_parametros.aceptado = true and v_parametros.introducido = true ) then

                create temporary table tt_verificacion_documento(_id_usuario_ai int4, _nombre_usuario_ai varchar,
                id_notificacion_solicitud int4, documento varchar, id_tramite varchar, tipo_documento varchar,
                transaction_id  varchar, id_gestion INT4,id_periodo INT4)
                on commit drop;


                select documento,
                	   tipo_documento,
                       id_estado_wf
                  into v_documento, v_tipo_documento, v_id_estado_wf
                from agetic.tdatos_enviados_cdig d
                where id_tramite =  v_parametros.request_uuid;

                insert into tt_verificacion_documento
                select
         		id_usuario_ai,
				usuario_ai,
                id_notificacion_solicitud,
                v_documento,
                request_uuid,
                v_tipo_documento,
                transaction_id,
                v_id_gestion,
                v_id_periodo
                from agetic.tnotificacion_solicitud_aprobacion
                where id_notificacion_solicitud = v_id_notificacion_solicitud;

                v_resp = agetic.ft_verificacion_documento_ime (
                p_administrador,
                p_id_usuario,
                'tt_verificacion_documento',
                'AGETIC_VERFDOC_INS');

                update wf.testado_wf
                set
                aprobado_digital = 'si'
                where id_estado_wf = v_id_estado_wf;

            end if;

			--Definicion de la respuesta
			v_resp = pxp.f_agrega_clave(v_resp,'msg','notificación solicitud aprobación almacenado(a) con exito (id_notificacion_solicitud'||v_id_notificacion_solicitud||')');
            v_resp = pxp.f_agrega_clave(v_resp,'finalizado','true'::varchar);
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','notificación solicitud aprobación almacenado con exito'::varchar);

            --Devuelve la respuesta
            return v_resp;

		end;

	/*********************************
 	#TRANSACCION:  'AGETIC_NTSOLAPB_MOD'
 	#DESCRIPCION:	Modificacion de registros
 	#AUTOR:		breydi.vasquez
 	#FECHA:		15-07-2020 15:03:30
	***********************************/

	elsif(p_transaccion='AGETIC_NTSOLAPB_MOD')then

		begin
			--Sentencia de la modificacion
			update agetic.tnotificacion_solicitud_aprobacion set
			aceptado = v_parametros.aceptado,
			introducido = v_parametros.introducido,
			request_uuid = v_parametros.request_uuid,
			codigo_operacion = v_parametros.codigo_operacion,
			mensaje = v_parametros.mensaje,
			transaction_id = v_parametros.transaction_id,
			fecha_hora_solicitud = v_parametros.fecha_hora_solicitud,
			hash_datos = v_parametros.hash_datos,
			ci = v_parametros.ci,
			id_gestion = v_parametros.id_gestion,
			id_periodo = v_parametros.id_periodo,
			id_usuario_mod = p_id_usuario,
			fecha_mod = now(),
			id_usuario_ai = v_parametros._id_usuario_ai,
			usuario_ai = v_parametros._nombre_usuario_ai
			where id_notificacion_solicitud=v_parametros.id_notificacion_solicitud;

			--Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','notificación solicitud aprobación modificado(a)');
            v_resp = pxp.f_agrega_clave(v_resp,'id_notificacion_solicitud',v_parametros.id_notificacion_solicitud::varchar);

            --Devuelve la respuesta
            return v_resp;

		end;

	/*********************************
 	#TRANSACCION:  'AGETIC_NTSOLAPB_ELI'
 	#DESCRIPCION:	Eliminacion de registros
 	#AUTOR:		breydi.vasquez
 	#FECHA:		15-07-2020 15:03:30
	***********************************/

	elsif(p_transaccion='AGETIC_NTSOLAPB_ELI')then

		begin
			--Sentencia de la eliminacion
			delete from agetic.tnotificacion_solicitud_aprobacion
            where id_notificacion_solicitud=v_parametros.id_notificacion_solicitud;

            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','notificación solicitud aprobación eliminado(a)');
            v_resp = pxp.f_agrega_clave(v_resp,'id_notificacion_solicitud',v_parametros.id_notificacion_solicitud::varchar);

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

ALTER FUNCTION agetic.ft_notificacion_solicitud_aprobacion_ime (p_administrador integer, p_id_usuario integer, p_tabla varchar, p_transaccion varchar)
  OWNER TO postgres;
