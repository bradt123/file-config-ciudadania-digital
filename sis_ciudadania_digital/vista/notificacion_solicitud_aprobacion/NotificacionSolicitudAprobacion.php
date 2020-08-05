<?php
/**
*@package pXP
*@file NotificacionSolicitudAprobacion.php
*@author  (breydi.vasquez)
*@date 15-07-2020 15:03:30
*@description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
*/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
Phx.vista.NotificacionSolicitudAprobacion=Ext.extend(Phx.gridInterfaz,{

	constructor:function(config){
		this.maestro=config.maestro;
    	//llama al constructor de la clase padre
		Phx.vista.NotificacionSolicitudAprobacion.superclass.constructor.call(this,config);
		this.init();
		this.load({params:{start:0, limit:this.tam_pag}})
	},

	Atributos:[
		{
			//configuracion del componente
			config:{
					labelSeparator:'',
					inputType:'hidden',
					name: 'id_notificacion_solicitud'
			},
			type:'Field',
			form:true
		},
		{
			config:{
				name: 'codigo_operacion',
				fieldLabel: 'Codigo Operacion',
				allowBlank: false,
				anchor: '80%',
				gwidth: 100,
				maxLength:-5
			},
				type:'TextField',
				filters:{pfiltro:'ntsolapb.codigo_operacion',type:'string'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config:{
				name: 'aceptado',
				fieldLabel: 'Aceptado',
				allowBlank: false,
				anchor: '80%',
				gwidth: 100,
				renderer : function(value) {
					if(value=="t"){a = 'True'; c = "darkgreen"; }else{ a = "False"; c= "red";};
					return String.format('{0}', '<span style="color:'+c+'; font-weight:bold;">'+a+'</span>');
				}
			},
				type:'Checkbox',
				filters:{pfiltro:'ntsolapb.aceptado',type:'boolean'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config:{
				name: 'introducido',
				fieldLabel: 'Introducido',
				allowBlank: false,
				anchor: '80%',
				gwidth: 100,
				renderer : function(value) {
					if(value=="t"){i = 'True'; c = "darkgreen"; }else{ i = "False"; c= "red";};
					return String.format('{0}', '<span style="color:'+c+'; font-weight:bold;">'+i+'</span>');
				}
			},
				type:'Checkbox',
				filters:{pfiltro:'ntsolapb.introducido',type:'boolean'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config:{
				name: 'request_uuid',
				fieldLabel: 'Request Uuid',
				allowBlank: false,
				anchor: '80%',
				gwidth: 100,
				maxLength:-5
			},
				type:'TextField',
				filters:{pfiltro:'ntsolapb.request_uuid',type:'string'},
				id_grupo:1,
				grid:true,
				form:true
		},

		{
			config:{
				name: 'mensaje',
				fieldLabel: 'Mensaje',
				allowBlank: false,
				anchor: '80%',
				gwidth: 100,
				maxLength:-5
			},
				type:'TextField',
				filters:{pfiltro:'ntsolapb.mensaje',type:'string'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config: {
				name: 'transaction_id',
				fieldLabel: 'Transaccion ID',
				allowBlank: false,
				emptyText: 'Elija una opción...',
				store: new Ext.data.JsonStore({
					url: '../../sis_/control/Clase/Metodo',
					id: 'id_',
					root: 'datos',
					sortInfo: {
						field: 'nombre',
						direction: 'ASC'
					},
					totalProperty: 'total',
					fields: ['id_', 'nombre', 'codigo'],
					remoteSort: true,
					baseParams: {par_filtro: 'movtip.nombre#movtip.codigo'}
				}),
				valueField: 'id_',
				displayField: 'nombre',
				gdisplayField: 'desc_',
				hiddenName: 'transaction_id',
				forceSelection: true,
				typeAhead: false,
				triggerAction: 'all',
				lazyRender: true,
				mode: 'remote',
				pageSize: 15,
				queryDelay: 1000,
				anchor: '100%',
				gwidth: 150,
				minChars: 2,
				renderer : function(value, p, record) {
					return String.format('{0}', record.data['transaction_id']);
				}
			},
			type: 'ComboBox',
			id_grupo: 0,
			filters: {pfiltro: 'movtip.nombre',type: 'string'},
			grid: true,
			form: true
		},
		{
			config:{
				name: 'fecha_hora_solicitud',
				fieldLabel: 'Fecha Solicitud',
				allowBlank: false,
				anchor: '80%',
				gwidth: 100,
				maxLength:-5
			},
				type:'TextField',
				filters:{pfiltro:'ntsolapb.fecha_hora_solicitud',type:'string'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config:{
				name: 'hash_datos',
				fieldLabel: 'Hash Datos',
				allowBlank: false,
				anchor: '80%',
				gwidth: 100,
				maxLength:-5
			},
				type:'TextField',
				filters:{pfiltro:'ntsolapb.hash_datos',type:'string'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config:{
				name: 'ci',
				fieldLabel: 'CI',
				allowBlank: false,
				anchor: '80%',
				gwidth: 100,
				maxLength:-5
			},
				type:'TextField',
				filters:{pfiltro:'ntsolapb.ci',type:'string'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config: {
				name: 'id_gestion',
				fieldLabel: 'Gestion',
				allowBlank: true,
				emptyText: 'Elija una opción...',
				store: new Ext.data.JsonStore({
					url: '../../sis_/control/Clase/Metodo',
					id: 'id_',
					root: 'datos',
					sortInfo: {
						field: 'nombre',
						direction: 'ASC'
					},
					totalProperty: 'total',
					fields: ['id_', 'nombre', 'codigo'],
					remoteSort: true,
					baseParams: {par_filtro: 'movtip.nombre#movtip.codigo'}
				}),
				valueField: 'id_',
				displayField: 'nombre',
				gdisplayField: 'desc_',
				hiddenName: 'id_gestion',
				forceSelection: true,
				typeAhead: false,
				triggerAction: 'all',
				lazyRender: true,
				mode: 'remote',
				pageSize: 15,
				queryDelay: 1000,
				anchor: '50%',
				gwidth: 50,
				minChars: 2,
				renderer : function(value, p, record) {
					return String.format('{0}', record.data['gestion']);
				}
			},
			type: 'ComboBox',
			id_grupo: 0,
			filters: {pfiltro: 'movtip.nombre',type: 'string'},
			grid: true,
			form: true
		},
		{
			config: {
				name: 'id_periodo',
				fieldLabel: 'Mes',
				allowBlank: true,
				emptyText: 'Elija una opción...',
				store: new Ext.data.JsonStore({
					url: '../../sis_/control/Clase/Metodo',
					id: 'id_',
					root: 'datos',
					sortInfo: {
						field: 'nombre',
						direction: 'ASC'
					},
					totalProperty: 'total',
					fields: ['id_', 'nombre', 'codigo'],
					remoteSort: true,
					baseParams: {par_filtro: 'movtip.nombre#movtip.codigo'}
				}),
				valueField: 'id_',
				displayField: 'nombre',
				gdisplayField: 'desc_',
				hiddenName: 'id_periodo',
				forceSelection: true,
				typeAhead: false,
				triggerAction: 'all',
				lazyRender: true,
				mode: 'remote',
				pageSize: 15,
				queryDelay: 1000,
				anchor: '50%',
				gwidth: 50,
				minChars: 2,
				renderer : function(value, p, record) {
					return String.format('{0}', record.data['mes']);
				}
			},
			type: 'ComboBox',
			id_grupo: 0,
			filters: {pfiltro: 'movtip.nombre',type: 'string'},
			grid: true,
			form: true
		},
		{
			config:{
				name: 'usr_reg',
				fieldLabel: 'Creado por',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'usu1.cuenta',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'fecha_reg',
				fieldLabel: 'Fecha creación',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
							format: 'd/m/Y',
							renderer:function (value,p,record){return value?value.dateFormat('d/m/Y H:i:s'):''}
			},
				type:'DateField',
				filters:{pfiltro:'ntsolapb.fecha_reg',type:'date'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'estado_reg',
				fieldLabel: 'Estado Reg.',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:10
			},
				type:'TextField',
				filters:{pfiltro:'ntsolapb.estado_reg',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'id_usuario_ai',
				fieldLabel: 'Fecha creación',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'ntsolapb.id_usuario_ai',type:'numeric'},
				id_grupo:1,
				grid:false,
				form:false
		},
		{
			config:{
				name: 'usuario_ai',
				fieldLabel: 'Funcionaro AI',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:300
			},
				type:'TextField',
				filters:{pfiltro:'ntsolapb.usuario_ai',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'usr_mod',
				fieldLabel: 'Modificado por',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'usu2.cuenta',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'fecha_mod',
				fieldLabel: 'Fecha Modif.',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
							format: 'd/m/Y',
							renderer:function (value,p,record){return value?value.dateFormat('d/m/Y H:i:s'):''}
			},
				type:'DateField',
				filters:{pfiltro:'ntsolapb.fecha_mod',type:'date'},
				id_grupo:1,
				grid:true,
				form:false
		}
	],
	tam_pag:50,
	title:'notificación solicitud aprobación',
	ActSave:'../../sis_ciudadania_digital/control/NotificacionSolicitudAprobacion/insertarNotificacionSolicitudAprobacion',
	ActDel:'../../sis_ciudadania_digital/control/NotificacionSolicitudAprobacion/eliminarNotificacionSolicitudAprobacion',
	ActList:'../../sis_ciudadania_digital/control/NotificacionSolicitudAprobacion/listarNotificacionSolicitudAprobacion',
	id_store:'id_notificacion_solicitud',
	fields: [
		{name:'id_notificacion_solicitud', type: 'numeric'},
		{name:'estado_reg', type: 'string'},
		{name:'aceptado', type: 'string'},
		{name:'introducido', type: 'string'},
		{name:'request_uuid', type: 'string'},
		{name:'codigo_operacion', type: 'string'},
		{name:'mensaje', type: 'string'},
		{name:'transaction_id', type: 'string'},
		{name:'fecha_hora_solicitud', type: 'string'},
		{name:'hash_datos', type: 'string'},
		{name:'ci', type: 'string'},
		{name:'id_gestion', type: 'numeric'},
		{name:'id_periodo', type: 'numeric'},
		{name:'id_usuario_reg', type: 'numeric'},
		{name:'fecha_reg', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
		{name:'id_usuario_ai', type: 'numeric'},
		{name:'usuario_ai', type: 'string'},
		{name:'id_usuario_mod', type: 'numeric'},
		{name:'fecha_mod', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
		{name:'usr_reg', type: 'string'},
		{name:'usr_mod', type: 'string'},
		{name:'gestion', type: 'numeric'},
		{name:'mes', type: 'string'},

	],
	sortInfo:{
		field: 'id_notificacion_solicitud',
		direction: 'ASC'
	},
	bdel:false,
	bsave:false,
	bnew:false,
	bedit:false,
	btest:false
	}
)
</script>
