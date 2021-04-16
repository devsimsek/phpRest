<?php

if (!class_exists("Curl")) {
    /**
     * Curl Library For phpRest api system.
     * Copyright (C)mtnsmsk.
     */
    class Curl
    {
        private $url;
        private $options;

        /**
         * @param string $url Request URL
         * @param array $options cURL options
         */
        public function __construct($url, array $options = [])
        {
            $this->url = $url;
            $this->options = $options;
        }

        /**
         * Get the response
         * @return string
         * @throws \RuntimeException On cURL error
         */
        public function __invoke(array $post)
        {
            $ch = \curl_init($this->url);

            foreach ($this->options as $key => $val) {
                \curl_setopt($ch, $key, $val);
            }

            \curl_setopt($ch, \CURLOPT_RETURNTRANSFER, true);
            \curl_setopt($ch, \CURLOPT_POSTFIELDS, $post);

            $response = \curl_exec($ch);
            $error = \curl_error($ch);
            $errno = \curl_errno($ch);

            if (\is_resource($ch)) {
                \curl_close($ch);
            }

            if (0 !== $errno) {
                throw new \RuntimeException($error, $errno);
            }

            return $response;
        }
    }
}