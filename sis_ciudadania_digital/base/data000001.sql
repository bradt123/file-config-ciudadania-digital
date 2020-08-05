/*******************************************I-DAT-BVP-CIUDADANIA-DIGITAL-0-13/07/2020***********************************************/
----------------------------------
--COPY LINES TO data.sql FILE
---------------------------------

select pxp.f_insert_tgui (' <img width="25px" height="25px" src="../../../lib/imagenes/icono_awesome/finger_digital.png" alt="Ciudadania Digital"> CIUDADANÍA DIGITAL', 'CIUDADANÍA DIGITAL', 'AGETIC', 'si', 1, '', 1, '', '', 'AGETIC');
select pxp.f_insert_tgui ('Parametros', 'Parametros', 'PARAMCDIG', 'si', 1, '', 2, '', '', 'AGETIC');
select pxp.f_insert_tgui ('Procesos', 'Procesos', 'PROCDIG', 'si', 2, '', 2, '', '', 'AGETIC');
select pxp.f_insert_tgui ('Reportes', 'Reportes', 'REPCDIG', 'si', 3, '', 2, '', '', 'AGETIC');
select pxp.f_delete_tgui ('NOTAPDIG');
select pxp.f_insert_tgui ('Notificaciones Solicitud Aprobación', 'Notificaciones Solicitud de Aprobación', 'NTSOLAPB', 'si', 1, 'sis_ciudadania_digital/vista/notificacion_solicitud_aprobacion/NotificacionSolicitudAprobacion.php', 3, '', 'NotificacionSolicitudAprobacion', 'AGETIC');

/*******************************************F-DAT-BVP-CIUDADANIA-DIGITAL-0-13/07/2020***********************************************/
