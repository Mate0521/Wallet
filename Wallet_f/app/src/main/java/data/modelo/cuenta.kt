package data.modelo

import android.os.Parcelable
import kotlinx.parcelize.Parcelize

@Parcelize
data class cuenta(
    val id_cuenta: String?,
    var saldo: Double?,
    val id_usuario :String?,
): Parcelable
