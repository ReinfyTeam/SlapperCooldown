# SlapperCooldown
[![](https://poggit.pmmp.io/shield.state/SlapperCooldown)](https://poggit.pmmp.io/p/SlapperCooldown)
[![](https://poggit.pmmp.io/shield.api/SlapperCooldown)](https://poggit.pmmp.io/p/SlapperCooldown)<br>

Adds a configurable cooldown between player hits on Slappers for PocketMine-MP.

# Requirements

- PocketMine-MP API 5.0.0 or newer.
- PHP 8.1 or newer.
- The [Slapper](https://github.com/ReinfyTeam/Slapper) plugin.

The plugin is maintained by ReinfyTeam. Compatibility checks in this campaign use
[Axolotl-PM](https://github.com/NhanAZ/Axolotl-PM), a PocketMine-MP-compatible
server distribution.

# Features
- Configure the hit delay and the message shown when a player hits too quickly.

# Disclaimer
This plugin is designed for PocketMine-MP. If you are using a fork or spoon of PocketMine-MP, please report issues to that project instead.

# How to Install?
- You must have the Slapper plugin. You can download it from [Poggit](https://poggit.pmmp.io/p/Slapper/).
- Just put this plugin in your `plugins/` folder, and it should work!<br>
- You can configure the plugin in `plugin_data/SlapperCooldown/config.yml`.

# Report a Issue/Bug
You found a bug or a plugin issue?
- Contact support in the [Discord Server](https://discord.gg/v2rNeHaptd)
- Create an [Issue](https://github.com/ReinfyTeam/SlapperCooldown/issues)
- Write your bug & the issue you are having with all informations including the crash or errors so I can track the issue.
- Submit the issue and be patient for a response for a solution to your problem :D

# Build and test

The build process uses DevTools to package and validate the plugin PHAR.
Development checks use Composer and PHPStan with the following commands:

    composer install
    composer analyse

The packaged plugin must retain plugin.yml, the resources/ directory and the
PHP source under src/.

# License

SlapperCooldown is licensed under the GNU Lesser General Public License v3.0 or later.
