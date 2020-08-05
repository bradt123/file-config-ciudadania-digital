<?php
/**
*@package pXP
*@file NotificacionAprobacion.php
*@author  (breydi.vasquez)
*@date 30-06-2020 16:16:14
*@description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
*/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
Phx.vista.NotificacionAprobacion=Ext.extend(Phx.gridInterfaz,{

	constructor:function(config){
		this.maestro=config.maestro;
    	//llama al constructor de la clase padre
		Phx.vista.NotificacionAprobacion.superclass.constructor.call(this,config);
		this.init();
		this.load({params:{start:0, limit:this.tam_pag}})
	},

	Atributos:[
		{
			//configuracion del componente
			config:{
					labelSeparator:'',
					inputType:'hidden',
					name: 'id_notificacion'
			},
			type:'Field',
			form:true
		},
		{
			config:{
				name: 'codigo_operacion',
				fieldLabel: 'Codigo Operacion',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:-5
			},
				type:'TextField',
				filters:{pfiltro:'notapd.codigo_operacion',type:'string'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config:{
				name: 'solicitud_uuid',
				fieldLabel: 'Solicitud uuid',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:-5
			},
				type:'TextField',
				filters:{pfiltro:'notapd.solicitud_uuid',type:'string'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config:{
				name: 'mensaje',
				fieldLabel: 'Mensaje',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:-5
			},
				type:'TextField',
				filters:{pfiltro:'notapd.mensaje',type:'string'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config: {
				name: 'id_transaccion',
				fieldLabel: 'ID Transaccion',
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
				hiddenName: 'id_transaccion',
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
					return String.format('{0}', record.data['id_transaccion']);
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
				name: 'fecha_solicitud',
				fieldLabel: 'Fecha Solicitud',
				allowBlank: true,
				anchor: '100%',
				gwidth: 120,
				maxLength:-5
			},
				type:'TextField',
				filters:{pfiltro:'notapd.fecha_solicitud',type:'string'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config:{
				name: 'hash_datos',
				fieldLabel: 'Hash Datos',
				allowBlank: true,
				anchor: '100%',
				gwidth: 120,
				maxLength:4
			},
				type:'TextField',
				filters:{pfiltro:'notapd.hash_datos',type:'string'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config:{
				name: 'ci',
				fieldLabel: 'CI',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:-5
			},
				type:'TextField',
				filters:{pfiltro:'notapd.ci',type:'string'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config:{
				name: 'aceptado',
				fieldLabel: 'Aceptado',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100
			},
				type:'Checkbox',
				filters:{pfiltro:'notapd.aceptado',type:'boolean'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config:{
				name: 'introducido',
				fieldLabel: 'Introducido',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100
			},
				type:'Checkbox',
				filters:{pfiltro:'notapd.introducido',type:'boolean'},
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
				filters:{pfiltro:'notapd.fecha_reg',type:'date'},
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
				filters:{pfiltro:'notapd.estado_reg',type:'string'},
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
				filters:{pfiltro:'notapd.id_usuario_ai',type:'numeric'},
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
				filters:{pfiltro:'notapd.usuario_ai',type:'string'},
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
				filters:{pfiltro:'notapd.fecha_mod',type:'date'},
				id_grupo:1,
				grid:true,
				form:false
		}
	],
	tam_pag:50,
	title:'notificacion_aprobacion',
	ActSave:'../../sis_ciudadania_digital/control/NotificacionAprobacion/insertarNotificacionAprobacion',
	ActDel:'../../sis_ciudadania_digital/control/NotificacionAprobacion/eliminarNotificacionAprobacion',
	ActList:'../../sis_ciudadania_digital/control/NotificacionAprobacion/listarNotificacionAprobacion',
	id_store:'id_notificacion',
	fields: [
		{name:'id_notificacion', type: 'numeric'},
		{name:'estado_reg', type: 'string'},
		{name:'aceptado', type: 'boolean'},
		{name:'introducido', type: 'boolean'},
		{name:'solicitud_uuid', type: 'string'},
		{name:'codigo_operacion', type: 'string'},
		{name:'mensaje', type: 'string'},
		{name:'id_transaccion', type: 'string'},
		{name:'fecha_solicitud', type: 'string'},
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
		{name:'gestion', type: 'string'},
		{name:'mes', type: 'string'}


	],
	sortInfo:{
		field: 'id_notificacion',
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
