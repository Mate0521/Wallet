package data.modelo.req

import android.os.Parcelable
import kotlinx.parcelize.Parcelize

@Parcelize
data class Autenticacion(
    val telefono: String,
    val clave: String
): Parcelable
