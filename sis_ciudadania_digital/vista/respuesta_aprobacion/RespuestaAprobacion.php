<?php
/**
*@package pXP
*@file RespuestaAprobacion.php
*@author  (breydi.vasquez)
*@date 30-06-2020 16:16:18
*@description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
*/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
Phx.vista.RespuestaAprobacion=Ext.extend(Phx.gridInterfaz,{

	constructor:function(config){
		this.maestro=config.maestro;
    	//llama al constructor de la clase padre
		Phx.vista.RespuestaAprobacion.superclass.constructor.call(this,config);
		this.init();
		this.load({params:{start:0, limit:this.tam_pag}})
	},

	Atributos:[
		{
			//configuracion del componente
			config:{
					labelSeparator:'',
					inputType:'hidden',
					name: 'id_respuesta'
			},
			type:'Field',
			form:true
		},
		{
			config:{
				name: 'finalizado',
				fieldLabel: 'finalizado',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100
			},
				type:'Checkbox',
				filters:{pfiltro:'resapd.finalizado',type:'boolean'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config:{
				name: 'link',
				fieldLabel: 'link',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:-5
			},
				type:'TextField',
				filters:{pfiltro:'resapd.link',type:'string'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config:{
				name: 'estado_proceso',
				fieldLabel: 'estado_proceso',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:-5
			},
				type:'TextField',
				filters:{pfiltro:'resapd.estado_proceso',type:'string'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config: {
				name: 'id_dato_enviado',
				fieldLabel: 'id_dato_enviado',
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
				hiddenName: 'id_dato_enviado',
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
					return String.format('{0}', record.data['desc_']);
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
				name: 'fecha_reg',
				fieldLabel: 'Fecha creación',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
							format: 'd/m/Y',
							renderer:function (value,p,record){return value?value.dateFormat('d/m/Y H:i:s'):''}
			},
				type:'DateField',
				filters:{pfiltro:'resapd.fecha_reg',type:'date'},
				id_grupo:1,
				grid:true,
				form:false
		}
	],
	tam_pag:50,
	title:'respuesta_aprobacion',
	ActSave:'../../sis_ciudadania_digital/control/RespuestaAprobacion/insertarRespuestaAprobacion',
	ActDel:'../../sis_ciudadania_digital/control/RespuestaAprobacion/eliminarRespuestaAprobacion',
	ActList:'../../sis_ciudadania_digital/control/RespuestaAprobacion/listarRespuestaAprobacion',
	id_store:'id_respuesta',
	fields: [
		{name:'id_respuesta', type: 'numeric'},
		{name:'finalizado', type: 'boolean'},
		{name:'link', type: 'string'},
		{name:'estado_proceso', type: 'string'},
		{name:'id_dato_enviado', type: 'numeric'},
		{name:'fecha_reg', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
		{name:'usr_reg', type: 'string'},
		{name:'usr_mod', type: 'string'},

	],
	sortInfo:{
		field: 'id_respuesta',
		direction: 'ASC'
	},
	bdel:true,
	bsave:true
	}
)
</script>
