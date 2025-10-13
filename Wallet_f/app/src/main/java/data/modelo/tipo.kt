package data.modelo

import android.os.Parcelable
import kotlinx.parcelize.Parcelize

@Parcelize
data class Tipo(
    val id_tipo:String,
    val nombre:String
): Parcelable
