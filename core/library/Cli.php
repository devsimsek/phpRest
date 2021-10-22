<?php

/**
 * Class Cli
 * Serve phpRest with its built-in cli
 * This File Only Loadable With The phpRest Cli At bin/phpRest
 */
if (isset($phpRestCLI)) {
    class Cli
    {
        /**
         * Log Errors To Console
         * @param $message
         * @return string
         */
        public function error($message)
        {
            return
                "$message\n
              phpRest [command] [argument]\n
             ";
        }

        /**
         * Log To Console
         * @param string $message
         */
        public function log(string $message)
        {
            echo $message . "\n";
        }

        /**
         * Trigger Help Message
         * @param string $message
         */
        public function help()
        {
            echo "Usage: phpRest <command>\n";
            echo "where <command> is one of:\n";
            echo "    serve, -h, -v\n";
            echo "phpRestCLI@0.0.1 /usr/local/lib/phpLib/phpRest\n";
        }

        /**
         * Parse Startup Arguments
         * @param $args
         */
        public function parse($args)
        {
            if ($args[1] === "serve") {
                $i = 1;
                $dir = "./";
                $port = 8100;
                foreach ($args as $a) {
                    if ($a === "serve") {

                        if ($args[$i] === "-h") {
                            $this->log("Usage: serve -d [dir] -p [port]");
                            exit();
                        }

                        if (!empty($args[$i++]) || $args[$i++] === "-d") {
                            $dir = $args[$i++];
                        }
                        if (!empty($args[$i++]) || $args[$i++] === "-p") {
                            $port = $args[$i++];
                        }
                    }
                    $i++;
                }
                $this->ignite($dir, $port);
            } else if (count($args) === 2) {
                $cmd = $args[1];
                $arg = $args[2];
                switch ($cmd) {
                    default:
                    case "help":
                    case "h":
                        $this->help();
                        break;
                    case "-v":
                    case "v":
                        $this->log("phpRestCLI v0.0.1");
                }
            } else {
                $this->help();
            }
        }

        /**
         * Ignite phpRest Cli Interface
         * @param string $directory
         * @param int $port
         * @param bool $save_log
         */
        public function ignite(string $directory = "./", int $port = 8100, bool $save_log = false)
        {
            $this->log("Starting phpRest in " . $port . " port, " . $directory . " directory.");
            $out = [];
            exec("php -S 127.0.0.1:" . $port . " -t " . $directory, $out);
            for ($i = 0; $i < count($out); $i++) {
                $this->log((string)$out);
            }
        }
    }
} else {
    print_r("Error! You can't load CLI library without using phpRestCLI\n");
    exit(0);
}