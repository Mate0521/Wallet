package modelo

data class Usuario(
    val id_usuario: String,
    val nombre: String,
    val apellidos: String,
    val correo: String,
    val telefono: String,
    val clave: String
)
