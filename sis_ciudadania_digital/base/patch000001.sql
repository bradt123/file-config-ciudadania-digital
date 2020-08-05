/***********************************I-SCP-BVP-CIUDADANIA-DIGITAL-0-13/07/2020****************************************/
CREATE TABLE agetic.tnotificacion_solicitud_aprobacion (
  id_notificacion_solicitud SERIAL,
  aceptado BOOLEAN NOT NULL,
  introducido BOOLEAN NOT NULL,
  request_uuid VARCHAR NOT NULL,
  codigo_operacion VARCHAR NOT NULL,
  mensaje TEXT NOT NULL,
  transaction_id VARCHAR NOT NULL,
  fecha_hora_solicitud VARCHAR NOT NULL,
  hash_datos VARCHAR NOT NULL,
  ci VARCHAR NOT NULL,
  id_gestion INTEGER,
  id_periodo INTEGER,
  CONSTRAINT tnotificacion_aprobacion_pkey PRIMARY KEY(id_notificacion_solicitud),
  CONSTRAINT tnotificacion_aprobacion_fk FOREIGN KEY (id_gestion)
    REFERENCES param.tgestion(id_gestion)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
    NOT DEFERRABLE,
  CONSTRAINT tnotificacion_aprobacion_fk1 FOREIGN KEY (id_periodo)
    REFERENCES param.tperiodo(id_periodo)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
    NOT DEFERRABLE
) INHERITS (pxp.tbase)
WITH (oids = false);

COMMENT ON TABLE agetic.tnotificacion_solicitud_aprobacion
IS 'tabla que almacena la informacion de notificacion de aprobacion de procesos,
estas notificaciones son enviadas desde los servicios de ciudadania digital.';

COMMENT ON COLUMN agetic.tnotificacion_solicitud_aprobacion.request_uuid
IS 'Identificador de la solicitud del trámite (el mismo que el sistema cliente
envío como idTramite al iniciar el flujo).';

ALTER TABLE agetic.tnotificacion_solicitud_aprobacion
  OWNER TO postgres;

/***********************************F-SCP-BVP-CIUDADANIA-DIGITAL-0-13/07/2020****************************************/
