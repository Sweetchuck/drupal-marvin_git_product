#!/usr/bin/env bash

: "${sghBridge:?'Git hook bridge file name is required'}"
: "${sghHookName:?'Git hook name is required'}"
: "${sghHasInput:?'Flag indicates that if the Git hook has stdInput or not is required'}"

echo >&2 "BEGIN Git hook: ${sghHookName}"

##
# @param int $1
#   Exit code.
#
# @return never
##
function sghExit ()
{
    echo >&2 "END   Git hook: ${sghHookName}"

    exit "${1}"
}

##
# Bash version of the PHP \in_array($needle, $haystack).
##
function sghInArray()
{
  local needle="${1}"
  : "${needle:?'needle argument is required'}"
  shift

  printf '%s\0' "${@}" | grep --fixed-strings --line-regexp --null-data --quiet -- "${needle}"
}

##
# You can do it, but not recommended.
# Example command to set the ignored hooks:
# `git config marvin.ignoredHooks 'foo bar'`
# The argument 'foo bar' is a space separated list.
##
# shellcheck disable=SC2207
declare -a sghIgnoredHooks=($(git config marvin.ignoredHooks))

##
# You can do it, but not recommended.
# Project specific ignored hooks can be added here.
# For example if the "drush marvin:git-hook:foo" does nothing,
# because there is no subscriber for that event.
##
#sghIgnoredHooks+=(
# 'foo'
#)

if sghInArray "${sghHookName}" "${sghIgnoredHooks[@]}"
then
  echo >&2 "${sghHookName} hook is ignored by Git config 'marvin.ignoredHooks'"

  sghExit 0
fi

# @todo
#   Detect that if this script running on host or inside Docker/DDev/Docksal/X
#   If it runs on host then does it have to be redirected into a container?
#   Does that container available?

# @todo Better detection for executables: php, composer.phar.
sghDrushExe="$(composer config 'bin-dir')/drush"
sghDrushGlobal=(
  '--config=drush'
)
sghDrushCommand="marvin:git-hook:${sghHookName}"

# shellcheck source=./.git-hooks-local
test -s "${sghBridge}-local" && . "${sghBridge}-local"


# Exit without error if "drush" doesn't exists.
# @todo Error message.
test -x "${sghDrushExe}" || sghExit 0

if [[ "${sghHasInput}" = 'true' ]]
then
    "${sghDrushExe}" "${sghDrushGlobal[@]}" "${sghDrushCommand}" "$@" <<< "$(</dev/stdin)" || sghExit $?
else
    "${sghDrushExe}" "${sghDrushGlobal[@]}" "${sghDrushCommand}" "$@" || sghExit $?
fi

sghExit 0
