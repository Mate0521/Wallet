package data.modelo.res

import android.os.Parcelable
import kotlinx.parcelize.Parcelize

@Parcelize
data class Mensaje(
    val exito: Boolean,
    val mensaje: String,
): Parcelable
