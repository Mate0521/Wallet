package data.modelo.req

import android.os.Parcelable
import kotlinx.parcelize.Parcelize

@Parcelize
data class Transaccion(
    val monto: Double,
    val destino:String,
    val id_cuenta: String,
    val id_tipo: String

): Parcelable
