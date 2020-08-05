CREATE OR REPLACE FUNCTION agetic.ft_verificacion_credencial_ime (
  p_administrador integer,
  p_id_usuario integer,
  p_tabla varchar,
  p_transaccion varchar
)
RETURNS varchar AS
$body$
/**************************************************************************
 SISTEMA:		Ciudadania digital
 FUNCION: 		agetic.ft_verificacion_credencial_ime
 DESCRIPCION:   Funcion que verifica las credenciales de cuidadania digital, que esten habilitadas
 AUTOR: 		 (breydi.vasquez)
 FECHA:	        14/07/2020
 COMENTARIOS:
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0
 #
 ***************************************************************************/

DECLARE

	v_parametros           	record;
	v_resp		            varchar;
	v_nombre_funcion        text;
	v_mensaje_error         text;
    v_valido			    varchar;
    v_estado_token			varchar;

BEGIN

    v_nombre_funcion = 'agetic.ft_verificacion_credencial_ime';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************
 	#TRANSACCION:  'AGETIC_VFTKHA_INS'
 	#DESCRIPCION:	Verififcacion de caducidad de access_token de usuario
 	#AUTOR:		breydi.vasquez
 	#FECHA:		30-06-2020 16:16:36
	***********************************/

	if(p_transaccion='AGETIC_VFTKHA_INS')then

        begin
        	--Sentencia de verificacion

               SELECT
                case when ((u.fecha_reg_token + interval '1 hour') > now()::timestamp) then
                    'si'
                else
                    'no'
                end
               into
                 v_valido

              FROM segu.tusuario u
              WHERE u.id_usuario = p_id_usuario;

              if v_valido = 'no' then
              	update segu.tusuario set
                estado_cd = 'inactivo'
                where id_usuario = p_id_usuario;
              end if;

               SELECT estado_cd into v_estado_token
               FROM segu.tusuario
               where id_usuario = p_id_usuario;

			--Definicion de la respuesta
              v_resp = pxp.f_agrega_clave(v_resp,'mensaje','verificaion de access_token');
              v_resp = pxp.f_agrega_clave(v_resp,'valido', v_valido::varchar);
              v_resp = pxp.f_agrega_clave(v_resp,'estado_token', v_estado_token::varchar);

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

ALTER FUNCTION agetic.ft_verificacion_credencial_ime (p_administrador integer, p_id_usuario integer, p_tabla varchar, p_transaccion varchar)
  OWNER TO "breydi.vasquez";
