        $(document).ready(function() {
///////////////////////////////////////////////////////////////////los mios
            $("#Telefono_fia_per").inputmask({
                mask: ["9999-9999", "", ],
                keepStatic: true
            });
            $("#ref_Telefono").inputmask({
                mask: ["9999-9999", "", ],
                keepStatic: true
            });
            
             $("#Dui_fia_per").inputmask({
                mask: ["99999999-9", "", ],
                keepStatic: true
            });
            
            
            
            $("#Nit_fia_per").inputmask({
                mask: ["9999-999999-999-9", "", ],
                keepStatic: true
            });
            
            
////////////////////////////////////////////////los que venian por defecto
            $("#telefone").inputmask({
                mask: ["(99) 9999-9999", "(99) 99999-9999", ],
                keepStatic: true
            });

            $("#celular").inputmask({
                mask: ["(99) 9999-9999", "(99) 99999-9999", ],
                keepStatic: true
            });

            $("#data").inputmask({
                mask: ["99/99/9999", "99/99/9999", {
                    placeholder: "",
                    clearMaskOnLostFocus: true
                }],
                keepStatic: true
            });

            $("#cnpj").inputmask({
                mask: ["99.999.999/9999-99", "99.999.999/9999-99", {
                    placeholder: "",
                    clearMaskOnLostFocus: true
                }],
                keepStatic: true
            });

            $("#cpf").inputmask({
                mask: ["999.999.999-99", "999.999.999-99", {
                    placeholder: "",
                    clearMaskOnLostFocus: true
                }],
                keepStatic: true
            });

            $("#rg").inputmask({
                mask: ["99.999.999-9", "99.999.999-9", {
                    placeholder: "",
                    clearMaskOnLostFocus: true
                }],
                keepStatic: true
            });

            $("#agencia").inputmask({
                mask: ["9999-9", "9999-9", {
                    placeholder: "",
                    clearMaskOnLostFocus: true
                }],
                keepStatic: true
            });

            $("#conta").inputmask({
                mask: ["99.999-9", "99.999-9", {
                    placeholder: "",
                    clearMaskOnLostFocus: true
                }],
                keepStatic: true
            });

            $("#cep").inputmask({
                mask: ["99999-999", "99999-999", {
                    placeholder: "",
                    clearMaskOnLostFocus: true
                }],
                keepStatic: true
            });

            $("#certificadoreservista").inputmask({
                mask: ["(99) 9999-9999", "(99) 99999-9999", {
                    placeholder: "teste",
                    clearMaskOnLostFocus: true
                }],
                keepStatic: true
            });

            $("#tituloeleitor").inputmask({
                mask: ["(99) 9999-9999", "(99) 99999-9999", {
                    placeholder: "",
                    clearMaskOnLostFocus: true
                }],
                keepStatic: true
            });

            $("#passaporte").inputmask({
                mask: ["(99) 9999-9999", "(99) 99999-9999", {
                    placeholder: "",
                    clearMaskOnLostFocus: true
                }],
                keepStatic: true
            });
        });
