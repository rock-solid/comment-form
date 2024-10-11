import globals from 'globals';
import path from 'node:path';
import { fileURLToPath } from 'node:url';
import js from '@eslint/js';
import { FlatCompat } from '@eslint/eslintrc';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);
const compat = new FlatCompat({
  baseDirectory: __dirname,
  recommendedConfig: js.configs.recommended,
  allConfig: js.configs.all,
});

export default [
  {
    ignores: [
      '**/node_modules',
      '**/lib',
      '**/modules',
      '**/vendor',
      '**/build',
    ],
  },
  ...compat.extends('eslint:recommended'),
  {
    languageOptions: {
      globals: {
        ...globals.browser,
        ...globals.node,
        jQuery: 'readonly',
        Swiper: 'readonly',
        WebFont: 'readonly',
        wp: 'readonly',
        '__webpack_public_path__': 'writable',
      },

      ecmaVersion: 2022,
      sourceType: 'module',
    },

    rules: {
      indent: [
        'error',
        2,
        {
          SwitchCase: 1,
        },
      ],

      quotes: ['error', 'single'],
      semi: ['error', 'always'],
      eqeqeq: ['warn', 'smart'],
      'no-var': 'error',
      'no-console': 'warn',
    },
  },
];
