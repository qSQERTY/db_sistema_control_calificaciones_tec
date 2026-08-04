<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ReporteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'numero_control' => 'required|string|max:255',
            'nombre_completo' => 'required|string|max:255',
            'carrera' => 'required|string|max:255',
            'horario' => 'required|string|max:255',
            'tipo_alumno' => 'required|string|max:255',
            'calificacion_final' => 'required|numeric|min:0|max:100',
        ];
    }

        public function messages()
        {
            return [
                'numero_control.required' => 'El número de control es obligatorio.',
                'nombre_completo.required' => 'El nombre completo es obligatorio.',
                'carrera.required' => 'La carrera es obligatoria.',
                'horario.required' => 'El horario es obligatorio.',
                'tipo_alumno.required' => 'El tipo de alumno es obligatorio.',
                'calificacion_final.required' => 'La calificación final es obligatoria.',
                'calificacion_final.numeric' => 'La calificación final debe ser un número.',
                'calificacion_final.min' => 'La calificación final no puede ser menor a 0.',
                'calificacion_final.max' => 'La calificación final no puede ser mayor a 100.',
            ];
        }

        public function attributes()
        {
            return [
                'numero_control' => 'Número de Control',
                'nombre_completo' => 'Nombre Completo',
                'carrera' => 'Carrera',
                'horario' => 'Horario',
                'tipo_alumno' => 'Tipo de Alumno',
                'calificacion_final' => 'Calificación Final',
            ];
        }
}
