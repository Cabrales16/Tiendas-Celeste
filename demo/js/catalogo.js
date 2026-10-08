// Datos de ejemplo del modo demo (todo es ficticio). Precios en COP, inventados para la demo.
export const CATEGORIAS = {
  "desayunos": "🍟Desayunos sorpresa🍩",
  "peluches": "🧸Peluches🐈",
  "dulces": "🍬Dulces🍧",
  "accesorios": "🏍️Accesorios⌚",
  "juguetes": "🪁Juguetes🔫",
  "maquillaje": "💄Maquillaje✂️",
  "regalos": "✨Regalos🎁"
};

export const PRODUCTOS = [
  {
    "codigo": 1,
    "nombre": "Desayuno con sandwich",
    "precio": 45000,
    "stock": 15,
    "unidad": "unidad",
    "descripcion": "Disfruta de un delicioso sándwich acompañado de una selección de sorpresas cuidadosamente elegidas. Perfecto para alegrar el día de alguien especial o celebrar una ocasión importante.",
    "categoria": "desayunos",
    "img": "desayuno1.jpeg",
    "oferta": false
  },
  {
    "codigo": 2,
    "nombre": "Desayuno variado",
    "precio": 55000,
    "stock": 22,
    "unidad": "unidad",
    "descripcion": "Un desayuno completo debe ser variado, es decir, que se componga de alimentos que formen parte de los tres grandes grupos: proteína, cereales y fruta o verdura.",
    "categoria": "desayunos",
    "img": "desayuno2.jpg",
    "oferta": false
  },
  {
    "codigo": 3,
    "nombre": "Desayuno con pastel",
    "precio": 40000,
    "stock": 29,
    "unidad": "unidad",
    "descripcion": "Este saludable pastel de zanahoria y avena con cobertura de queso crema y yogurt griego es perfecto para disfrutar en el desayuno, como merienda o un postre.",
    "categoria": "desayunos",
    "img": "desayuno3.jpg",
    "oferta": false
  },
  {
    "codigo": 4,
    "nombre": "Oso de peluche",
    "precio": 35000,
    "stock": 11,
    "unidad": "unidad",
    "descripcion": "Suave y adorable oso de peluche con un lazo de satén. Perfecto para abrazar y brindar consuelo, este osito es el compañero ideal para todas las edades.",
    "categoria": "peluches",
    "img": "peluches1.jpeg",
    "oferta": false
  },
  {
    "codigo": 5,
    "nombre": "Gato de peluche",
    "precio": 32000,
    "stock": 18,
    "unidad": "unidad",
    "descripcion": "Encantador gato de peluche con un pelaje aterciopelado y detalles realistas. Este felino es perfecto para los amantes de los gatos y se convertirá en el amigo inseparable de cualquier niño.",
    "categoria": "peluches",
    "img": "peluches2.jpeg",
    "oferta": false
  },
  {
    "codigo": 6,
    "nombre": "Perro de peluche",
    "precio": 38000,
    "stock": 25,
    "unidad": "unidad",
    "descripcion": "Tierno perro de peluche con orejas caídas y una expresión amigable. Hecho de materiales de alta calidad, este perrito es perfecto para abrazar y jugar, convirtiéndose en el mejor amigo de cualquier niño.",
    "categoria": "peluches",
    "img": "peluches3.jpg",
    "oferta": false
  },
  {
    "codigo": 7,
    "nombre": "Paquete de gomitas",
    "precio": 8000,
    "stock": 32,
    "unidad": "unidad",
    "descripcion": "Disfruta de nuestras gomitas, elaboradas con ingredientes de alta calidad y disponibles en una variedad de sabores frutales. Perfectas para cualquier ocasión, estas gomitas son el dulce ideal para compartir o disfrutar solo.",
    "categoria": "dulces",
    "img": "dulces1.jpeg",
    "oferta": false
  },
  {
    "codigo": 8,
    "nombre": "Chocolatinas",
    "precio": 6000,
    "stock": 14,
    "unidad": "unidad",
    "descripcion": "Estas exquisitas chocolatinas están hechas con el mejor chocolate amargo y rellenas de sabor. Su masa hojaldrada se derrite en la boca, revelando un corazón de chocolate suave. Perfectas para acompañar el café o como un dulce capricho",
    "categoria": "dulces",
    "img": "dulces2.jpeg",
    "oferta": false
  },
  {
    "codigo": 9,
    "nombre": "Galletas",
    "precio": 7000,
    "stock": 21,
    "unidad": "unidad",
    "descripcion": "Disfruta de nuestras galletas hechas a mano con ingredientes naturales. Perfectas para acompañar tu café o té, y para compartir con amigos y familiares. ¡Un bocado de felicidad en cada mordisco!",
    "categoria": "dulces",
    "img": "dulces3.jpg",
    "oferta": false
  },
  {
    "codigo": 10,
    "nombre": "Reloj",
    "precio": 120000,
    "stock": 28,
    "unidad": "unidad",
    "descripcion": "Elegante y moderno reloj de mano con correa de cuero genuino y esfera analógica. Perfecto para cualquier ocasión, combina estilo y funcionalidad con precisión suiza.",
    "categoria": "accesorios",
    "img": "accesorios1.jpg",
    "oferta": false
  },
  {
    "codigo": 11,
    "nombre": "Cadena de corazones",
    "precio": 25000,
    "stock": 10,
    "unidad": "unidad",
    "descripcion": "Hermosa cadena de corazones hecha de plata esterlina. Cada corazón está delicadamente elaborado para resaltar su brillo y elegancia, ideal para regalar a esa persona especial.",
    "categoria": "accesorios",
    "img": "accesorios2.jpeg",
    "oferta": false
  },
  {
    "codigo": 12,
    "nombre": "Anillo",
    "precio": 18000,
    "stock": 17,
    "unidad": "unidad",
    "descripcion": "Anillo de diseño clásico hecho de oro de 18 quilates con un diamante central. Una joya atemporal que simboliza compromiso y amor eterno, perfecta para ocasiones especiales.",
    "categoria": "accesorios",
    "img": "accesorios3.jpeg",
    "oferta": false
  },
  {
    "codigo": 13,
    "nombre": "Juguete de bebe",
    "precio": 22000,
    "stock": 24,
    "unidad": "unidad",
    "descripcion": "Adorable bebé de juguete con cuerpo suave y detalles realistas. Viene con un conjunto de ropa y accesorios, perfecto para que los niños disfruten cuidando y mimando a su propio bebé.",
    "categoria": "juguetes",
    "img": "juguetes1.png",
    "oferta": false
  },
  {
    "codigo": 14,
    "nombre": "Juguetes para bebes",
    "precio": 30000,
    "stock": 31,
    "unidad": "unidad",
    "descripcion": "Completo kit de juguetes para bebés que incluye sonajeros, bloques de construcción, y juguetes de actividades. Diseñado para estimular el desarrollo sensorial y motor, es el regalo perfecto para los más pequeños.",
    "categoria": "juguetes",
    "img": "juguetes2.jpeg",
    "oferta": false
  },
  {
    "codigo": 15,
    "nombre": "Optimus prime",
    "precio": 65000,
    "stock": 13,
    "unidad": "unidad",
    "descripcion": "Impresionante figura de Optimus Prime de juguete, transformable de camión a robot. Con detalles fieles al personaje y múltiples puntos de articulación, es el regalo ideal para los fans de Transformers de todas las edades.",
    "categoria": "juguetes",
    "img": "juguetes3.jpeg",
    "oferta": false
  },
  {
    "codigo": 16,
    "nombre": "Kit de labiales",
    "precio": 28000,
    "stock": 20,
    "unidad": "unidad",
    "descripcion": "Conjunto de labiales de larga duración en una variedad de tonos vibrantes. Con una fórmula hidratante y de alta pigmentación, estos labiales brindan un color intenso y un acabado suave y sedoso.",
    "categoria": "maquillaje",
    "img": "maquillaje1.jpeg",
    "oferta": false
  },
  {
    "codigo": 17,
    "nombre": "Pestañina",
    "precio": 15000,
    "stock": 27,
    "unidad": "unidad",
    "descripcion": "Pestañina voluminizadora que alarga y define cada pestaña. Con una fórmula resistente al agua y de larga duración, esta pestañina te dará unas pestañas espectaculares durante todo el día.",
    "categoria": "maquillaje",
    "img": "maquillaje2.jpeg",
    "oferta": false
  },
  {
    "codigo": 18,
    "nombre": "Rubor",
    "precio": 18000,
    "stock": 9,
    "unidad": "unidad",
    "descripcion": "Rubor en polvo con una textura suave y fácil de difuminar. Disponible en varios tonos naturales que aportan un toque de color y luminosidad a tus mejillas, perfecto para un look fresco y radiante.",
    "categoria": "maquillaje",
    "img": "maquillaje3.jpeg",
    "oferta": false
  },
  {
    "codigo": 19,
    "nombre": "Collage de fotos",
    "precio": 30000,
    "stock": 16,
    "unidad": "unidad",
    "descripcion": "Hermoso collage de fotos personalizable en un marco elegante. Perfecto para exhibir tus recuerdos más preciados, este collage es una excelente opción para decorar cualquier espacio con un toque personal y creativo.",
    "categoria": "regalos",
    "img": "regalos1.jpg",
    "oferta": false
  },
  {
    "codigo": 20,
    "nombre": "Audifonos inalambricos con orejas de gato",
    "precio": 55000,
    "stock": 23,
    "unidad": "unidad",
    "descripcion": "Divertidos y modernos audífonos inalámbricos con orejas de gato iluminadas. Con sonido de alta calidad, conectividad Bluetooth y un diseño cómodo, estos audífonos son ideales para amantes de la música y el estilo único.",
    "categoria": "regalos",
    "img": "regalos2.jpeg",
    "oferta": false
  },
  {
    "codigo": 21,
    "nombre": "Llaveros",
    "precio": 10000,
    "stock": 30,
    "unidad": "unidad",
    "descripcion": "Set de llaveros de alta calidad con diseños variados y encantadores. Perfectos para personalizar tus llaves o mochilas, estos llaveros son prácticos y agregan un toque de diversión y estilo a tus pertenencias.",
    "categoria": "regalos",
    "img": "regalos3.jpeg",
    "oferta": false
  },
  {
    "codigo": 22,
    "nombre": "Pocillo de regalo",
    "precio": 28000,
    "stock": 12,
    "unidad": "unidad",
    "descripcion": "El posillo de regalo es un encantador conjunto de sorpresas cuidadosamente seleccionadas. Puede incluir dulces, bolsos, desayunos sorpresa y otros artículos especiales. Es el regalo perfecto para celebrar ocasiones especiales o simplemente para alegrar el día de alguien.",
    "categoria": "regalos",
    "img": "posilloregalo.jpeg",
    "oferta": true
  },
  {
    "codigo": 23,
    "nombre": "Caja de dulces",
    "precio": 18000,
    "stock": 19,
    "unidad": "unidad",
    "descripcion": "La caja de dulces es un comestible compuesto de azúcar, con un sabor dulce muy agradable al paladar. Puede contener una variedad de delicias como chocolates, galletas, tartas o pasteles. Es ideal para regalar o disfrutar en ocasiones especiales.",
    "categoria": "dulces",
    "img": "cajadedulces.jpeg",
    "oferta": true
  },
  {
    "codigo": 24,
    "nombre": "Cadena de corazón",
    "precio": 22000,
    "stock": 26,
    "unidad": "unidad",
    "descripcion": "Una elegante y delicada cadena con un colgante en forma de corazón. Perfecta para expresar amor y cariño, ideal para regalar en ocasiones especiales o para añadir un toque romántico a tu estilo diario.",
    "categoria": "accesorios",
    "img": "cadena.jpeg",
    "oferta": true
  }
];
