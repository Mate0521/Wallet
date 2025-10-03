package modelo.res

import modelo.Cuenta
import modelo.Usuario

data class EntradaRes(
    val usuario: Usuario?,
    val cuenta: Cuenta?,

    )
