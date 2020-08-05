<script>
Phx.vista.ViewResponse=Ext.extend(Phx.gridInterfaz,{

	constructor:function(config){
		this.maestro=config.maestro;
    	//llama al constructor de la clase padre
		Phx.vista.ViewResponse.superclass.constructor.call(this,config);
		this.init();

	},
  Atributos:[

		{
        config:{
            name: 'nombres',
            fieldLabel: 'Funcionario',
            gwidth:200,
						renderer: function (value, p, record) {
								return '<div class="x-combo-list-item">' +
										'<p><b>Nombres: </b><span style="color:#274d80;">' + record.data['nombres'] + '</span></p>' +
										'<p><b>Primer Apellido: </b><span style="color:#274d80;">' + record.data['primer_apellido'] + '</span></p>' +
										'<p><b>Segundo Apellido: </b><span style="color:#274d80;">' + record.data['segundo_apellido'] + '</span></p>' +
										'</div>'
						}
        },
        type:'TextField',
				filters:{pfiltro:'nombres',type:'string'},
				bottom_filter: true,
        id_grupo:1,
        grid:true
    },
		{
			config:{
				name: 'fecha_solicitud',
				fieldLabel: 'Fecha Solicitud',
				anchor: '120%',
				gwidth: 150,
				renderer: function (value, p, record) {
						return '<div class="x-combo-list-item">' +
								'<p><span style="color:#274d80;">' + record.data['fecha_solicitud'] + '</span></p>' +
								'</div>'
				}
			},
				type:'TextField',
				id_grupo:1,
				grid:true
		},
		{
				config:{
						name: 'descripcion',
						fieldLabel: 'Descripcion',
						gwidth:250,
						renderer: function (value, p, record) {
								return '<div class="x-combo-list-item">' +
										'<p><span style="color:#274d80;">' + record.data['descripcion'] + '</span></p>' +
										'</div>'
						}
				},
				type:'TextField',
				filters:{pfiltro:'descripcion',type:'string'},
				bottom_filter: true,
				id_grupo:1,
				grid:true
		},
		{
        config:{
            name: 'primer_apellido',
						fieldLabel: 'Primer Apellido',
            gwidth:100
        },
        type:'TextField',
				filters:{pfiltro:'primer_apellido',type:'string'},
				bottom_filter: true,
        id_grupo:1,
				grid:false
    },

		{
        config:{
            name: 'segundo_apellido',
						fieldLabel: 'Segundo Apellido',
            gwidth:10
        },
        type:'TextField',
				filters:{pfiltro:'primer_apellido',type:'string'},
				bottom_filter: true,
        id_grupo:1,
				grid:false,
    },

		{
        config:{
            name: 'fecha_reg',
            fieldLabel: 'Fecha',
            gwidth:100,
            // renderer: function (value, p, record) {
            //     console.log('data');
            //   }
        },
        type:'TextField',
        id_grupo:1,
        grid:false
    },
  ],
	tam_pag:50,
	title:'Funcionarios Aprobadores',
	ActList:'../../sis_ciudadania_digital/control/VerificacionDocumento/listarregistroDatosVerificacion',
  fields: [
		{name:'nombres', type: 'string'},
		{name:'primer_apellido', type: 'string'},
		{name:'segundo_apellido', type: 'string'},
		{name:'fecha_solicitud', type: 'string'},
    {name:'descripcion', type: 'string'},
    {name:'fecha_reg', type: 'string'}

  ],
	sortInfo:{
		field: 'fecha_solicitud',
		direction: 'ASC'
	},

	onReloadPage: function(m) {
		if (m.registros!=undefined) {
			this.store.baseParams.registros=JSON.stringify(m);
			this.load( { params: { start:0, limit: this.tam_pag } });
		}
	},

  bdel:false,
  bsave:false,
  bnew:false,
  bedit:false,
  btest:false,
});
</script>
