package data.modelo

import android.os.Parcelable
import kotlinx.parcelize.Parcelize
import java.util.Date

@Parcelize
data class Transaccion(
    val id_transaccion:String,
    val monto: Double,
    val destino:String,
    val fecha:Date,
    val id_cuenta: String,
    val id_tipo: String
): Parcelable
