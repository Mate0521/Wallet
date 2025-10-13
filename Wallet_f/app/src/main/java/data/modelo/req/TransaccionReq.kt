package data.modelo.req

import android.os.Parcelable
import kotlinx.parcelize.Parcelize

@Parcelize
data class TransaccionReq(
    val monto: Double,
    val destino:String,
    val id_cuenta: String,
    var tipo: String

): Parcelable
