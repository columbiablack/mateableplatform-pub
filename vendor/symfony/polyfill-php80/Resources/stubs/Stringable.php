<?php

/**
 * Copyright (c) 2024-2026. Mateable LLC
 */

if (\PHP_VERSION_ID < 80000) {
    interface Stringable
    {
        /**
         * @return string
         */
        public function __toString();
    }
}
