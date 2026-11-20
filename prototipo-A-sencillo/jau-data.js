/* Industrias JAU · Banco único de contenido para los prototipos A, B y C.
   Todo lo marcado pc:true está pendiente de confirmar con el cliente. */
(function () {
  /* foto: ruta o URL de la imagen del producto (p. ej. 'img/productos/p1.jpg'). Vacío = espacio «foto por confirmar». */
  var P = function (linea, nombre, marca, foto) { return { linea: linea, nombre: nombre, marca: marca || 'Por confirmar', presentacion: 'Presentación por confirmar', foto: foto || '', verificado: false }; };
  /* V = producto verificado en comercios venezolanos (ver «Investigación productos JAU»). */
  var V = function (linea, nombre, marca, pres, foto) { return { linea: linea, nombre: nombre, marca: marca, presentacion: pres || 'Presentación por confirmar', foto: foto || '', verificado: true }; };
  var productos = [
    V('refrescos', 'Drink Cola 1,5 L', 'Drink Cola', '1,5 L', 'img/productos/drinkcola-1500.png'),
    V('refrescos', 'Drink Cola 400 ml', 'Drink Cola', '400 ml', 'img/productos/drinkcola-400.png'),
    V('jugos', 'Frugy Naranja 1,5 L', 'Frugy', '1,5 L', 'img/productos/frugy-naranja-1500.png'),
    V('jugos', 'Frugy Naranja 500 ml', 'Frugy', '500 ml', 'img/productos/frugy-naranja-500.png'),
    V('jugos', 'Frugy Naranja 250 ml', 'Frugy', '250 ml', 'img/productos/frugy-naranja-250.png'),
    V('jugos', 'Frugy Pera 1,5 L', 'Frugy', '1,5 L', 'img/productos/frugy-pera-1500.png'),
    V('jugos', 'Frugy Pera 500 ml', 'Frugy', '500 ml', 'img/productos/frugy-pera-500.png'),
    V('jugos', 'Frugy Pera 250 ml', 'Frugy', '250 ml', 'img/productos/frugy-pera-250.png'),
    V('jugos', 'Frugy Manzana 1,5 L', 'Frugy', '1,5 L', 'img/productos/frugy-manzana-1500.png'),
    V('jugos', 'Frugy Manzana 500 ml', 'Frugy', '500 ml', 'img/productos/frugy-manzana-500.png'),
    V('jugos', 'Frugy Manzana 250 ml', 'Frugy', '250 ml', 'img/productos/frugy-manzana-250.png'),
    V('jugos', 'Frugy Mango 1,5 L', 'Frugy', '1,5 L', 'img/productos/frugy-mango-1500.png'),
    V('jugos', 'Frugy Mango 500 ml', 'Frugy', '500 ml', 'img/productos/frugy-mango-500.png'),
    V('jugos', 'Frugy Mango 250 ml', 'Frugy', '250 ml', 'img/productos/frugy-mango-250.png'),
    V('jugos', 'Frugy Limón Coco 1,5 L', 'Frugy', '1,5 L', 'img/productos/frugy-limoncoco-1500.png'),
    V('jugos', 'Frugy Limón Coco 500 ml', 'Frugy', '500 ml', 'img/productos/frugy-limoncoco-500.png'),
    V('jugos', 'Frugy Limón Coco 250 ml', 'Frugy', '250 ml', 'img/productos/frugy-limoncoco-250.png'),
    V('jugos', 'Frugy Durazno 1,5 L', 'Frugy', '1,5 L', 'img/productos/frugy-durazno-1500.png'),
    V('jugos', 'Frugy Durazno 500 ml', 'Frugy', '500 ml', 'img/productos/frugy-durazno-500.png'),
    V('jugos', 'Frugy Durazno 250 ml', 'Frugy', '250 ml', 'img/productos/frugy-durazno-250.png')
  ].map(function (p, i) { p.id = 'p' + (i + 1); return p; });

  /* El número de presentaciones que aparece en los textos sale de esta lista:
     al sumar o quitar un producto, se actualiza solo en los tres prototipos. */
  var N = productos.length;
  var META = 21; /* productos que el cliente anunció */
  var faltan = META - N;

  var I = {
    caja: 'M3 7.5 12 3l9 4.5v9L12 21l-9-4.5z M3 7.5 12 12l9-4.5 M12 12v9',
    pin: 'M12 21s-7-6.2-7-11.5a7 7 0 0 1 14 0C19 14.8 12 21 12 21z M12 7.5a2 2 0 1 0 0 4 2 2 0 0 0 0-4z',
    doc: 'M6 3h9l4 4v14H6z M14 3v5h5 M9 13h7 M9 17h7',
    chat: 'M4 5h16v11H10l-6 4z M8 10h8',
    mail: 'M3 6h18v12H3z M3 6l9 7 9-7',
    red: 'M12 3a9 9 0 1 0 0 18 9 9 0 0 0 0-18z M3 12h18 M12 3c3 3.5 3 14.5 0 18 M12 3c-3 3.5-3 14.5 0 18',
    reloj: 'M12 3a9 9 0 1 0 0 18 9 9 0 0 0 0-18z M12 7v5l3 2',
    meta: 'M12 3a9 9 0 1 0 0 18 9 9 0 0 0 0-18z M12 8a4 4 0 1 0 0 8 4 4 0 0 0 0-8z',
    valores: 'M12 20s-7-4.5-7-10a4 4 0 0 1 7-2.6A4 4 0 0 1 19 10c0 5.5-7 10-7 10z',
    camion: 'M2 6h12v10H2z M14 10h4l3 3v3h-7 M6 18.5a1.5 1.5 0 1 0 0 .01 M17 18.5a1.5 1.5 0 1 0 0 .01',
    flecha: 'M5 12h14 M13 6l6 6-6 6',
    wa: 'M5 19.5l1.2-3.7A8 8 0 1 1 9 18.7z M9 9.5c.3 2.2 2.3 4.2 4.5 4.5l1-1.2 2 .9'
  };

  window.JAU = {
    marca: 'Industrias JAU',
    cta: 'Quiero ser distribuidor',
    nav: [
      { id: 'inicio', label: 'Inicio' },
      { id: 'servicios', label: 'Servicios' },
      { id: 'nosotros', label: 'Sobre nosotros' },
      { id: 'productos', label: 'Productos' },
      { id: 'contacto', label: 'Contacto' }
    ],
    iconos: I,
    inicio: {
      etiqueta: 'Distribución de bebidas',
      titulo: 'Bebidas para tu negocio, con un aliado que distribuye',
      texto: 'Industrias JAU distribuye Drink Cola y Frugy, ' + N + ' presentaciones entre refrescos y jugos, y busca nuevos distribuidores. Conoce las líneas, revisa el catálogo y escríbenos para empezar.',
      ctaSec: 'Ver productos',
      cierreTitulo: '¿Quieres distribuir nuestros productos?',
      cierreTexto: 'Déjanos tus datos y el equipo de ventas te contactará con las condiciones para distribuidores.'
    },
    lineas: [
      { id: 'refrescos', nombre: 'Refrescos', desc: 'Drink Cola, bebida gaseosa sabor a cola negra, en 400 ml y 1,5 L.' },
      { id: 'jugos', nombre: 'Jugos', desc: 'Frugy en 6 sabores: naranja, pera, manzana, mango, limón coco y durazno. En 250 ml, 500 ml y 1,5 L.' }
    ],
    lineasPc: true,
    servicios: {
      titulo: 'Servicios para distribuidores',
      intro: 'Lo que ofrece Industrias JAU a los negocios que se suman como distribuidores.',
      items: [
        { id: 's1', icono: I.caja, titulo: 'Portafolio de productos', texto: 'Acceso a todas las líneas que distribuye Industrias JAU, con un catálogo que crecerá el próximo año.', pc: false },
        { id: 's2', icono: I.pin, titulo: 'Cobertura', texto: 'Zonas de despacho y frecuencia de entrega para cada distribuidor.', pc: false },
        { id: 's3', icono: I.doc, titulo: 'Condiciones comerciales', texto: 'Pedido mínimo, formas de pago y lista de precios para distribuidores.', pc: false },
        { id: 's4', icono: I.chat, titulo: 'Atención directa de ventas', texto: 'Un canal de WhatsApp con el equipo de ventas para pedidos y consultas.', pc: false }
      ]
    },
    nosotros: {
      titulo: 'Sobre nosotros',
      intro: 'Industrias JAU es una empresa distribuidora de bebidas que hoy maneja ' + N + ' presentaciones de Drink Cola y Frugy y proyecta duplicar su portafolio el próximo año.',
      bloques: [
        { id: 'n1', icono: I.reloj, titulo: 'Historia', texto: 'Nacimos para llevar bebidas de calidad a bodegas, abastos y supermercados de todo el país, y hoy crecemos junto a nuestros distribuidores.' },
        { id: 'n2', icono: I.meta, titulo: 'Misión', texto: 'Abastecer a cada negocio con productos que su cliente pide, a tiempo y con un trato cercano.' },
        { id: 'n3', icono: I.valores, titulo: 'Valores', texto: 'Cumplimiento, cercanía y transparencia en cada pedido y en cada relación comercial.' },
        { id: 'n4', icono: I.camion, titulo: 'Capacidad', texto: 'Almacén propio, flota de despacho y rutas semanales para atender a nuestros distribuidores.' }
      ]
    },
    contacto: {
      titulo: 'Contacto',
      intro: 'Completa el formulario para ser distribuidor o escribe directo al equipo de ventas.',
      canales: [
        { id: 'c1', icono: I.wa, titulo: 'WhatsApp de ventas', valor: '+58 412 000 0000' },
        { id: 'c2', icono: I.mail, titulo: 'Correo de solicitudes', valor: 'ventas@industriasjau.com' },
        { id: 'c3', icono: I.pin, titulo: 'Dirección', valor: 'Valencia, Carabobo, Venezuela' },
        { id: 'c4', icono: I.red, titulo: 'Redes sociales', valor: '@industriasjau' }
      ]
    },
    formulario: {
      titulo: 'Quiero ser distribuidor',
      campos: [
        { id: 'nombre', label: 'Nombre y apellido', tipo: 'text', req: true },
        { id: 'empresa', label: 'Empresa o negocio', tipo: 'text', req: true },
        { id: 'ciudad', label: 'Ciudad o zona', tipo: 'text', req: true },
        { id: 'telefono', label: 'Teléfono o WhatsApp', tipo: 'tel', req: true },
        { id: 'correo', label: 'Correo electrónico', tipo: 'email', req: true },
        { id: 'tipo', label: 'Tipo de negocio', tipo: 'select', req: true, opciones: ['Selecciona una opción', 'Bodega o abasto', 'Supermercado', 'Mayorista', 'Distribuidor', 'Otro'] },
        { id: 'mensaje', label: 'Mensaje (opcional)', tipo: 'textarea', req: false }
      ],
      enviar: 'Enviar solicitud',
      exito: 'Recibimos tu solicitud. El equipo de ventas te contactará pronto.',
      nota: 'Te respondemos en menos de 24 horas hábiles.'
    },
    whatsapp: { label: 'Escríbenos por WhatsApp', aviso: 'Abriendo WhatsApp de ventas…' },
    productos: productos,
    pendientes: [
      'Logo en vector, versión clara y oscura',
      'Colores y tipografía de marca',
      'Fotos, nombres, presentaciones y descripciones de los 21 productos',
      faltan > 0 ? (faltan === 1 ? 'El producto que falta' : 'Los ' + faltan + ' productos que faltan') + ' para llegar a ' + META + ' (hoy hay ' + N + ' confirmados: Drink Cola y Frugy)' : '',
      'Textos de Sobre nosotros: historia, misión, valores y capacidad',
      'Servicios: cobertura y condiciones generales para distribuidores',
      'Número de WhatsApp de ventas',
      'Correo que recibe las solicitudes de distribuidores',
      'Dirección y redes sociales',
      'Dominio definitivo y subdominio de pruebas'
    ].filter(Boolean),
    validar: function (campos, valores) {
      var e = {};
      campos.forEach(function (c) {
        var v = (valores[c.id] || '').trim();
        if (c.req && (!v || (c.tipo === 'select' && v === c.opciones[0]))) e[c.id] = 'Campo obligatorio';
        else if (c.tipo === 'email' && v && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v)) e[c.id] = 'Correo no válido';
      });
      return e;
    },
    filtrar: function (linea, marca, q) {
      q = (q || '').toLowerCase();
      return productos.filter(function (p) {
        return (linea === 'todas' || p.linea === linea) && (marca === 'todas' || p.marca === marca) && (!q || p.nombre.toLowerCase().indexOf(q) > -1);
      });
    },
    marcas: ['Drink Cola', 'Frugy'],
    lineaNombre: function (id) { var l = window.JAU.lineas.filter(function (x) { return x.id === id; })[0]; return l ? l.nombre : id; }
  };

  /* Lógica compartida de los componentes base (formulario, WhatsApp, catálogo, navegación).
     A, B y C solo cambian la apariencia; el funcionamiento sale de aquí. */
  window.JAU.estadoInicial = function () {
    return { page: 'inicio', w: window.innerWidth, form: {}, errors: {}, sent: false, linea: 'todas', marca: 'todas', q: '', menu: false, toast: false, detalle: null };
  };
  window.JAU.montar = function (self) {
    self._onResize = function () { self.setState({ w: window.innerWidth }); };
    window.addEventListener('resize', self._onResize);
  };
  window.JAU.desmontar = function (self) { window.removeEventListener('resize', self._onResize); clearTimeout(self._t); };
  window.JAU.comun = function (self) {
    var J = window.JAU, s = self.state, page = self.props.page || s.page;
    var go = function (id) {
      if (self.props.onNav) self.props.onNav(id); else self.setState({ page: id });
      self.setState({ menu: false, detalle: null });
      window.scrollTo(0, 0);
    };
    var setF = function (id, v) { var f = Object.assign({}, self.state.form); f[id] = v; var e = Object.assign({}, self.state.errors); delete e[id]; self.setState({ form: f, errors: e }); };
    var campos = J.formulario.campos.map(function (c) {
      return Object.assign({}, c, {
        value: s.form[c.id] || (c.tipo === 'select' ? c.opciones[0] : ''),
        error: s.errors[c.id] || '', hasError: !!s.errors[c.id],
        isSelect: c.tipo === 'select', isArea: c.tipo === 'textarea', isInput: c.tipo !== 'select' && c.tipo !== 'textarea',
        reqMark: c.req ? '*' : '',
        onChange: function (e) { setF(c.id, e.target.value); }
      });
    });
    var lineasF = [{ id: 'todas', nombre: 'Todas' }].concat(J.lineas).map(function (l) {
      return { id: l.id, nombre: l.nombre, active: s.linea === l.id, pick: function () { self.setState({ linea: l.id }); } };
    });
    var marcasF = ['todas'].concat(J.marcas).map(function (m) {
      return { id: m, nombre: m === 'todas' ? 'Todas las marcas' : m, active: s.marca === m, pick: function () { self.setState({ marca: m }); } };
    });
    var verDet = function (id) { if (page !== 'productos') go('productos'); self.setState({ detalle: id }); window.scrollTo(0, 0); };
    var base = function (p) { return p.nombre.replace(' ' + p.presentacion, ''); };
    var bulto = { '1,5 L': '6 unidades', '500 ml': '12 unidades', '400 ml': '12 unidades', '250 ml': '24 unidades' };
    var dp = page === 'productos' && s.detalle ? J.productos.filter(function (p) { return p.id === s.detalle; })[0] : null;
    var det = null;
    if (dp) {
      var sabor = base(dp).replace('Frugy ', '');
      det = Object.assign({}, dp, {
        base: base(dp), lineaNombre: J.lineaNombre(dp.linea),
        desc: dp.marca === 'Drink Cola' ? 'Bebida gaseosa sabor a cola negra. Refrescante y burbujeante, para acompañar las comidas y compartir en familia.' : 'Bebida con sabor a ' + sabor.toLowerCase() + '. Lista para tomar, ideal para servir bien fría en el desayuno, la merienda o la lonchera.',
        specs: [
          { k: 'Marca', v: dp.marca }, { k: 'Línea', v: J.lineaNombre(dp.linea) }, { k: 'Presentación', v: dp.presentacion },
          { k: 'Envase', v: 'Botella PET' }, { k: 'Unidades por bulto', v: bulto[dp.presentacion] || '12 unidades' }, { k: 'Conservación', v: 'Lugar fresco y seco' }
        ],
        tamanos: J.productos.filter(function (p) { return base(p) === base(dp); }).map(function (p) {
          return { label: p.presentacion, active: p.id === dp.id, inactive: p.id !== dp.id, pick: function () { self.setState({ detalle: p.id }); } };
        }),
        relacionados: J.productos.filter(function (p) { return p.linea === dp.linea && base(p) !== base(dp) && p.presentacion === dp.presentacion; }).concat(J.productos.filter(function (p) { return p.linea !== dp.linea && p.presentacion === '1,5 L'; })).slice(0, 4).map(function (p) {
          return Object.assign({}, p, { lineaNombre: J.lineaNombre(p.linea), hasFoto: !!p.foto, noFoto: !p.foto, ver: function () { self.setState({ detalle: p.id }); window.scrollTo(0, 0); } });
        }),
        consultar: function () { setF('mensaje', 'Me interesa: ' + dp.nombre); go('contacto'); },
        volver: function () { self.setState({ detalle: null }); window.scrollTo(0, 0); }
      });
    }
    var lista = J.filtrar(s.linea, s.marca, s.q).map(function (p) {
      return Object.assign({}, p, {
        lineaNombre: J.lineaNombre(p.linea), marcaPc: p.marca === 'Por confirmar', marcaLabel: p.marca === 'Por confirmar' ? 'Marca por confirmar' : p.marca,
        hasFoto: !!p.foto, noFoto: !p.foto,
        consultar: function () { setF('mensaje', 'Me interesa: ' + p.nombre); go('contacto'); }, ver: function () { verDet(p.id); }
      });
    });
    var destacados = ['p1', 'p3', 'p9', 'p12'].map(function (id) { return lista.filter(function (p) { return p.id === id; })[0] || J.productos.filter(function (p) { return p.id === id; })[0]; }).map(function (p) {
      return Object.assign({}, p, { hasFoto: !!p.foto, noFoto: !p.foto, lineaNombre: J.lineaNombre(p.linea), marcaLabel: p.marca === 'Por confirmar' ? 'Marca por confirmar' : p.marca, consultar: function () { setF('mensaje', 'Me interesa: ' + p.nombre); go('contacto'); }, ver: function () { verDet(p.id); } });
    });
    return {
      J: J, page: page, go: go,
      pInicio: page === 'inicio', pServicios: page === 'servicios', pNosotros: page === 'nosotros', pProductos: page === 'productos' && !det, pDetalle: !!det, det: det, pContacto: page === 'contacto',
      goInicio: function () { go('inicio'); }, goServicios: function () { go('servicios'); }, goNosotros: function () { go('nosotros'); }, goProductos: function () { go('productos'); }, goContacto: function () { go('contacto'); },
      isMobile: s.w < 900, isDesktop: s.w >= 900, w: s.w,
      menuOpen: s.menu, toggleMenu: function () { self.setState({ menu: !self.state.menu }); }, closeMenu: function () { self.setState({ menu: false }); },
      campos: campos, sent: s.sent, notSent: !s.sent,
      submit: function (e) {
        e.preventDefault();
        var vals = {}; campos.forEach(function (c) { vals[c.id] = c.value; });
        var err = J.validar(J.formulario.campos, vals);
        if (Object.keys(err).length) self.setState({ errors: err }); else self.setState({ sent: true, errors: {} });
      },
      resetForm: function () { self.setState({ sent: false, form: {}, errors: {} }); },
      lineasF: lineasF, marcasF: marcasF, q: s.q, onQ: function (e) { self.setState({ q: e.target.value }); },
      lista: lista, total: lista.length, vacio: lista.length === 0, totalLabel: lista.length === 1 ? '1 producto' : lista.length + ' productos',
      limpiar: function () { self.setState({ linea: 'todas', marca: 'todas', q: '' }); },
      destacados: destacados,
      toast: s.toast,
      wa: function (e) { if (e) e.preventDefault(); self.setState({ toast: true }); clearTimeout(self._t); self._t = setTimeout(function () { self.setState({ toast: false }); }, 2600); },
      year: new Date().getFullYear()
    };
  };
})();
