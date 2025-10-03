package modelo

import java.util.Date

data class Transaccion(
    val id_transaccion:String,
    val monto: Double,
    val destino:String,
    val fecha:Date,
    val id_cuenta: String,
    val id_tipo: String
)
