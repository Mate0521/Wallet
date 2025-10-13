package data.modelo.res

import android.os.Parcelable
import data.modelo.cuenta
import data.modelo.Usuario
import kotlinx.parcelize.Parcelize

@Parcelize
data class EntradaRes(
    val usuario: Usuario?,
    val cuenta: cuenta?
): Parcelable
