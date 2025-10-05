package data.modelo

import android.os.Parcelable
import kotlinx.parcelize.Parcelize

@Parcelize
data class login(
    val telefono : String,
    val clave :String,
): Parcelable
