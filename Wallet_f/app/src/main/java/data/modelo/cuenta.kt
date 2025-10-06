package data.modelo

import android.os.Parcelable
import kotlinx.parcelize.Parcelize

@Parcelize
data class cuenta(
    val id: String?,
    val saldo: Double?,
    val id_usuario :String?,
): Parcelable
