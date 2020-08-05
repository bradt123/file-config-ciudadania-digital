<?php
/**
*@package pXP
*@file VerificacionDocumento.php
*@author  (breydi.vasquez)
*@date 15-07-2020 15:03:27
*@description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
*/

header("content-type: text/javascript; charset=UTF-8");
?>
<style>
.icon-hash{
    background-image: url('../../../sis_ciudadania_digital/public/img/touch_finger_white.png');
    background-repeat: no-repeat;
    filter: saturate(250%);
    background-size: 19%;
}
.icon-transaction_id{
    background-image: url('../../../sis_ciudadania_digital/public/img/touch_finger_black.png');
    background-repeat: no-repeat;
    filter: saturate(250%);
    background-size: 14%;
}
</style>
<script>
Phx.vista.VerificacionDocumento=Ext.extend(Phx.gridInterfaz,{

	constructor:function(config){
		this.maestro=config.maestro;
    	//llama al constructor de la clase padre
		Phx.vista.VerificacionDocumento.superclass.constructor.call(this,config);
		this.grid.addListener('cellclick', this.oncellclick,this);

		this.init();
		this.load({params:{start:0, limit:this.tam_pag}})

		this.addButton('verificacion_documentos_digital_hash', {
				text: '<b>Verificación Documento Hash</b>',
				iconCls: 'icon-hash',
				disabled: false,
				handler: this.onVerifyHash
		});
		this.addButton('verificacion_documentos_digital_ID', {
				text: '<b>Verificación Documento transaccion ID</b>',
				iconCls: 'icon-transaction_id',
				disabled: false,
				handler: this.onVerifyTransID
		});
	},

	Atributos:[
		{
			//configuracion del componente
			config:{
					labelSeparator:'',
					inputType:'hidden',
					name: 'id_verificacion_documento'
			},
			type:'Field',
			form:true
		},
		{
			config:{
				name: 'documento',
				fieldLabel: 'Documento',
				allowBlank: true,
				anchor: '80%',
				gwidth: 80,
				renderer: function (value, p, record) {
					var result;
					 if(record.data.tipo_documento == "PDF") {
						  result = "<div style='text-align:center'><img border='0' style='-webkit-user-select:auto;cursor:pointer;' title='PDF' src = '../../../sis_ciudadania_digital/public/img/pdf.png' align='center' width='30' height='30'></div>";
					 }else{
							result = "<div style='text-align:center'><img border='0' style='-webkit-user-select:auto;cursor:pointer;' title='JSON' src = '../../../sis_ciudadania_digital/public/img/json.jpg' align='center' width='30' height='30'></div>";
					 }
					 return result;
			 }
			},
				type:'TextField',
				filters:{pfiltro:'verfdoc.documento',type:'string'},
				id_grupo:1,
				bottom_filter: true,
				grid:true,
				form:true
		},
		{
			config:{
				name: 'id_tramite',
				fieldLabel: 'Codigo',
				allowBlank: true,
				anchor: '220%',
				gwidth: 220
			},
				type:'TextField',
				filters:{pfiltro:'verfdoc.id_tramite',type:'string'},
				id_grupo:1,
				bottom_filter: true,
				grid:true,
				form:true
		},
		{
			config:{
				name: 'tipo_documento',
				fieldLabel: 'Tipo Documento',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:-5
			},
				type:'TextField',
				filters:{pfiltro:'verfdoc.tipo_documento',type:'string'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config:{
				name: 'transaction_id',
				fieldLabel: 'transaccion ID',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
			},
				type:'TextField',
				id_grupo:1,
				grid:false
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
					baseParams: {par_filtro: 'verfdoc.nombre#movtip.codigo'}
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
			filters: {pfiltro: 'verfdoc.nombre',type: 'string'},
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
					baseParams: {par_filtro: 'verfdoc.nombre#movtip.codigo'}
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
			filters: {pfiltro: 'verfdoc.nombre',type: 'string'},
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
				filters:{pfiltro:'verfdoc.fecha_reg',type:'date'},
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
				filters:{pfiltro:'verfdoc.estado_reg',type:'string'},
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
				filters:{pfiltro:'verfdoc.id_usuario_ai',type:'numeric'},
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
				filters:{pfiltro:'verfdoc.usuario_ai',type:'string'},
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
				filters:{pfiltro:'verfdoc.fecha_mod',type:'date'},
				id_grupo:1,
				grid:true,
				form:false
		}
	],
	tam_pag:50,
	title:'verificación documento aprobación',
	ActSave:'../../sis_ciudadania_digital/control/VerificacionDocumento/insertarVerificacionDocumento',
	ActDel:'../../sis_ciudadania_digital/control/VerificacionDocumento/eliminarVerificacionDocumento',
	ActList:'../../sis_ciudadania_digital/control/VerificacionDocumento/listarVerificacionDocumento',
	id_store:'id_verificacion_documento',
	fields: [
		{name:'id_verificacion_documento', type: 'numeric'},
		{name:'estado_reg', type: 'string'},
		{name:'documento', type: 'string'},
		{name:'id_tramite', type: 'string'},
		{name:'tipo_documento', type: 'string'},
		{name:'transaction_id', type: 'string'},
		{name:'id_gestion', type: 'string'},
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
		{name:'mes', type: 'string'}

	],
	sortInfo:{
		field: 'id_verificacion_documento',
		direction: 'ASC'
	},
	bdel:false,
	bsave:false,
	bnew:false,
	bedit:false,
	btest:false,

	oncellclick : function(grid, rowIndex, columnIndex, e) {
	    var record = this.store.getAt(rowIndex),
      fieldName = grid.getColumnModel().getDataIndex(columnIndex);

			if (fieldName == 'documento' && record.data.tipo_documento=='PDF') {
				var data = "id=" + record.data['id_verificacion_documento'];
				data += "&extension=pdf";
				data += "&sistema=sis_ciudadania_digital";
				data += "&clase=DocumentoCdigital";
				data += "&url="+record.data['documento'];
				//return  String.format('{0}',"<div style='text-align:center'><a target=_blank href = '../../../lib/lib_control/CTOpenFile.php?"+ data+"' align='center' width='70' height='70'>Abrir</a></div>");
				window.open('../../../lib/lib_control/CTOpenFile.php?' + data);
			}
	},
	onVerifyHash: function () {
		var rec=this.sm.getSelected();
		var NumSelect = this.sm.getCount();
		 if(NumSelect != 0){
			 this.onCallServiceVerify(rec, 'hash')
		 }else{
				 Ext.MessageBox.alert('Alerta', 'Antes debe seleccionar un item.');
		 }
	},

	onVerifyTransID: function () {
		var rec=this.sm.getSelected();
		var NumSelect = this.sm.getCount();
		 if(NumSelect != 0){
			 this.onCallServiceVerify(rec, 'transaction_id')
		 }else{
				 Ext.MessageBox.alert('Alerta', 'Antes debe seleccionar un item.');
		 }
	},

	onCallServiceVerify: function (rec, v) {
		var that = this;
		Ext.Ajax.request({
			 url : '../../sis_ciudadania_digital/control/VerificacionDocumento/verificacionDocumentoHash',
			 params : { tramite: rec.data.documento , tipo: rec.data.tipo_documento, transaction_id: rec.data.transaction_id,
			 					  t_v: v},
			 success : function (resp) {
					 var reg = JSON.parse(resp.responseText);
					 if (reg.conneccion) {
							 var data = JSON.parse(reg.response);
							 if(data.verificacionCorrecta){
									 // console.log("data", data);
									 that.onSubmit(data);
							 } else {
								 (data.mensaje==undefined)?msg=data.error:msg=data.mensaje;
								 alert(msg);
							 }
					 }else{
						 alert(reg.response);
					 }

			 },
			 failure : this.conexionFailure,
			 timeout : this.timeout,
			 scope : this
	 });
	},

	east: {
			url: '../../../sis_ciudadania_digital/vista/verificacion_documento/ViewResponse.php',
			title: 'Verificacion',
			width: '50%',
			cls: 'ViewResponse'
	},

	onSubmit: function (data) {
		console.log("thiss-",this);
		 this.onEnablePanel(this.idContenedor + '-east', data)
	},


	})
</script>
